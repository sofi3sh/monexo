<?php

namespace App\Http\Controllers\Backend;

use App\Models\Home\Currency;
use App\Models\Home\Rate;
use Carbon\Carbon;
use DB;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    /**
     * Основной путь к апи
     *
     * @var string
     */
    protected $path = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms=';


    /**
     * Название поля в базе с обозначением криптовалюты
     *
     * @var string
     */
    protected $currencyCodeFieldName = 'code';

    /**
     * Флаг, что чтение курса было выполнено с ошибкой.
     *
     * @var bool
     */
    public $isError = false;

    /**
     * Фалг, что надо записывать курсы в таблицу с историей
     *
     * @var bool
     */
    public $keepHistory = true;

    /**
     * К какой паре читать курсы с сервера
     *
     * @var string
     */
    private $pair = 'USD';

    /**
     * RateController constructor.
     * @param string $pair
     */
    public function __construct($pair = 'USD')
    {
        $this->pair = $pair;
    }


    /**
     * Возвращает список обозначений криптовалют для обновления
     *
     * @return mixed
     */
    public function getCurrencyArray()
    {
        return Currency::select('code')
            /*->where('check_rate', true)*/
            ->pluck('code')
            ->toArray();
    }


    public function getAllRates($token)
    {
        if (config('cryptocompare.rates_url_token') !== $token) abort(404);
        $this->readCurrenciesRatesFromServer();
    }
    /**
     * @param array|null $currenciesCodes
     * @throws \Exception
     */
    //todo-tk ВАЖНО в методе readCurrenciesRatesFromServer СДЕЛАТЬ ДОБАВЛЕНИЕ КУРСА USD
    public function readCurrenciesRatesFromServer(array $currenciesCodes = null)
    {
        $currencies = $currenciesCodes ?? $this->getCurrencyArray();
        $currencyRates = [];
        $blocks = array_chunk($currencies, 15);

        foreach ($blocks as $block) {
            // Преобразовываем массив криптовалют в строку и добавляем служебный префикс.
            $str = implode(',', $block) . '&tsyms=' . $this->pair;
            $path = $this->path . $str;

            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->get($path);
                $rates = json_decode($res->getBody(), true);

                // если АПИ вернуло ошибку
                if (isset($rates['Response']) && $rates['Response'] == "Error") {
                    throw new \Exception($rates['Message']);
                }
                $results = $rates['RAW']/*[$this->pair]*/
                ;
                foreach ($results as $code => $stats) {
                    $stats = $stats[$this->pair];

                    $finalRates[$code]['rate'] = $stats['PRICE'];
                    $finalRates[$code]['change'] = $stats['CHANGEPCT24HOUR'];
                }

                // Проверяем вернулись ли все курсы, которые запрашивались
                if (count($currencies) != count($finalRates)) {
                    foreach ($currencies as $key => $rate) {
                        if (!in_array($rate, $currencies)) {
                            throw new \Exception('Can\'t read rate: ' . $rate);
                        }
                    }
                }

            } catch (\Exception $e) {
                $this->log('error', [$e->getMessage()]);
                $this->log('request path', [$path]);
            }

            // Добавляем к существующему массиву курсов, новый прочитанный.
            $currencyRates = array_merge($currencyRates, $finalRates);
        }

        $this->syncWithDataBase($finalRates);
    }

    /**
     * Преобразовывает коллекцию в массив
     *
     * @param $rates
     * @return null
     */
    public function ratesPluck($rates)
    {
        $r = null;

        foreach ($rates as $code => $rate) {
            $r[$code] = $rate->rate;
        }

        return $r;
    }


    /**
     *  Обновление или создание записи в бд
     *
     * @param array $rates
     */
    private function syncWithDataBase(array $rates)
    {
        // В массиве $rates надо заменить ключ с символом криптовалюты на ее id
        $c = Currency::all();
        $c = $c->keyBy('code');

        foreach ($rates as $code => $rate) {
            // Пишем в лог, если новый курс значительно больше, чем ранее записанный в базу.
            //todo Доработать
            /*if (!Rate::where('code', $code)->get()->isEmpty()) {
                $oldRate = Rate::where('currency', $code)->first()->rate;
                $newPercent = abs($rate['rate'] - $oldRate) * 100 / $oldRate;
                if ($newPercent > config('app.maxAllowableDiffRateInPercent', 30)) {

                    $this->log("large_rate_change", [
                        "message" => "The rate $code has changed by " . round($rate['rate'], 2) . "%",
                        "old rare" => $oldRate,
                        "new rare" => $rate['rate'],
                    ]);
                }
            }*/
            // Пишем в историю
            // todo Доработать
            /*if ($this->keepHistory) {
                RateHistory::create([
                    'currency_code' => $code,
                    'rate' => $rate['rate'],
                    'trend' => $rate['change']
                ]);
            }*/
            $id = $c->get($code)->id;
            Rate::updateOrCreate(
                ['currency_id' => $id],
                ['rate'  => $rate['rate'],
                 'trend' => $rate['change']
                ]);
        }
    }

    /**
     * Возвращает значения курсов валют
     *
     * @param $currencies
     * @param string $pair
     * @param string $key
     * @return array|int
     * @throws \Exception
     */
    public function getRates($currencies = null, $pair = 'USD', $key = 'code')
    {
        // todo Сделать по-нормальному (через скоупы)
        if (is_null($currencies)) {
            $rates = Currency::leftJoin('rates', 'rates.currency_id', '=', 'currencies.id')
                ->where('currencies.is_crypto', 1)
                ->get(['currencies.id', 'currencies.code', 'rates.rate', 'rates.trend']);
        } else {
            // Если передан не массив - преобразовываем в массив
            $currencies = !is_array($currencies) ? [$currencies] : $currencies;

            $rates = Currency::leftJoin('rates', 'rates.currency_id', '=', 'currencies.id')
                ->whereIn('currencies.id', $currencies)
                ->get(['currencies.id', 'currencies.code', 'rates.rate', 'rates.trend']);
        }

        // Если был передан массив криптовалют для определения курсов
        if (count($rates) > 1) {
            $rates = $rates->keyBy($key);
        } else {
            $rates = $rates->pluck('rate')[0];
        }
        return $rates;

        // Определяем коэффициент, если надо курс не к 'USD'

        //todo Потом вернуться к возможности задавать пару
        //$this->getMultiplier($pair);
        // throw new \Exception('В базе не задан курс второй валюты для пары');
        // Проверяем, есть ли в базе курс второй валюты к которой определяется курс
        /*if (!Rate::where('currency_id', $pair)->orWhere('id', $pair)->get()->isEmpty()) {
            $multiplier = $pair != 'USD' ? Rate::where('currency', $pair)->first()->rate : 1;
            //$currencies = !is_array($currencies) ? [$currencies] : $currencies;

            $currencies = Currency::select('code')
                ->whereIn('code', $currencies)
                ->orWhereIn('id', $currencies)
                ->pluck('code')
                ->toArray();

            $rates = Rate::select(\DB::raw("rate/$multiplier as rate, currency"))
                ->whereIn('currency', $currencies)
                ->pluck('rate', 'currency')
                ->toArray();

            // Если указан не массив валют для определения курса, а одна, то возвращаем не массив, а значение
            $result = count($rates) != 1 ? $rates : array_shift($rates);
            return $result;
        }*/

        return [];
    }

    /**
     *
     * @param $currencies
     * @return mixed
     */
    public
    function getRateInstance($currency)
    {

        return Rate::select('code')
            ->whereIn('code', $currencies)
            ->orWhereIn('id', $currencies)
            ->get();
    }

    public
    function getMultiplier($pair)
    {
        $multiplier = ($pair != 'USD' ? $this->getCurrency($pair)->rate : 1);
        dd(2, $this->getCurrency('ETH'));
        /*if ($pair == 'USD') {
            $multiplier = 1;
        } else {
            dd(2, $this->getCurrency($pair)->rate);
            $multiplier = 1;
        }*/

        return $multiplier;
    }

    /**
     * Возвращает объект криптовалюты
     *
     * @param mixed $currency id или обозначение криптовалюты.
     * @return mixed
     * @throws \Exception
     */
    public
    function getCurrencyInstance($currency)
    {
        // Если передали id криптовалюты
        if (is_numeric($currency)) {
            $cur = Currency::where('id', $currency)->first();
        } else {
            $cur = Currency::where($this->currencyCodeFieldName, $currency)->first();
        }
        if (is_null($cur)) {
            throw new \Exception("В базе отсутствует курс криптовалюты " . (is_numeric($currency) ? "с id=$currency." : "$currency."));
        }

        return $cur;
    }

    /**
     * Возвращает id криптовалюты.
     *
     * @param mixed $currency id или обозначение криптовалюты.
     * @return mixed
     * @throws \Exception
     */
    public
    function getCurrencyId($currency)
    {
        //Если и так передали id криптовалюты
        if (is_numeric($currency)) {
            $id = $currency;
        } else {
            $id = Currency::select('id')
                ->where('code', $currency)
                ->first();
            if (is_null($id)) {
                throw new \Exception("В базе отсутствует курс $currency.");
            }
            $id = $id->id;
        }
        return $id;
    }

    /**
     * Записывает данные в лог
     *
     * @param $message
     * @param array $arr
     * @throws \Exception
     */
    public
    function log($message, array $arr = [])
    {

        /* Создаем логер  */
        $ratesLog = new Logger('rates');
        $ratesLog->pushHandler(new StreamHandler(storage_path('logs/rates.log')), Logger::INFO);

        $ratesLog->error($message, $arr);
    }


    /**
     * Возвращаen сколько прошло времени с момента последнего чтения курса.
     *
     * @return strings
     */
    public
    function getReadRatesTimeAgo()
    {
        Carbon::setLocale('ru');
        return Carbon::createFromTimeStamp(strtotime(Rate::orderBy('updated_at', 'desc')->first()->updated_at))->diffForHumans();
    }
}


