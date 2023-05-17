<?php

namespace App\Http\Controllers\Backend;

use App\Models\CryptocurrencyRate;
use App\Models\Home\CryptocurrencyExchange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * rate limit: 100,000 в месяц, т.е. 3225 в день, 134 в час, 2.2 раза в минуту.
 * Доп. лимиты: в сутки - 50,000, час - 25,000, минута - 2,500, секунда - 50.
 *
 * Class RateControllerMultiplyExchanges
 * @package App\Http\Controllers\Backend
 */
class RateControllerMultiplyExchanges extends Controller
{
    /**
     * @var integer Максимальное вермя, сек до которого курсы считаются не устаревшими.
     */
    private const MaxDiffRateAge = 60;

    /**
     * Базовый путь API для определения курса криптовалюты
     * %currency% - обозначение криптовалюты
     * %exchange% - название биржи
     * @var string
     */
    protected $path = 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=%currency%&tsyms=USD&e=%exchange%';

    /**
     * Возвращает массив с ключом-кодом криптовалюты и значением-курсом
     *
     * @param $currencies
     * @param $exchange
     * @return array
     */
    public function getRateFromAPI(string $currency, string $exchange)
    {
        //$currencies_str = implode(",", $currencies);
        $client = new \GuzzleHttp\Client();
        $path = str_replace('%currency%', $currency, $this->path);
        $path = str_replace('%exchange%', trim($exchange), $path);
        $res = $client->get($path);
        $rates = json_decode($res->getBody(), true);

        // Если API вернул ошибку
        if (isset($rates['Response']) && $rates['Response'] == "Error") {
            throw new \Exception($rates['Ошибка чтения курсов криптовалют.']);
            Log::channel('actionlog')->error('Ошибка чтения курсов с cryptocompare: ' . $rates['Message']);
            return [];
        }

        return $rates[$currency]['USD'];
    }

    public function getRatesFromExchanges(string $currency)
    {
        $cryptocurrency_exchanges = CryptocurrencyExchange::where('in_arbitrage_trading', 1)->get();

        // В цикле для всех бирж производим чтение курсов
        foreach ($cryptocurrency_exchanges as $cryptocurrency_exchange) {
            $r[$cryptocurrency_exchange->name] = $this->getRateFromAPI($currency, $cryptocurrency_exchange->sub_uri);
        }

        return $r;
    }

    public function getMinRate(string $currency)
    {
        $r = $this->getRatesFromExchanges($currency);
        $exchange = array_keys($r, min($r))[0];

        return [$exchange, min($r)];
    }

    public function getMaxRate(string $currency)
    {
        $r = $this->getRatesFromExchanges($currency);
        $exchange = array_keys($r, max($r))[0];

        return [$exchange, max($r)];
    }

}

