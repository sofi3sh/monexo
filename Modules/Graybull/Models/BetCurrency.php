<?php

namespace Modules\Graybull\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client as HttpClient;

/**
 * @property int $id ID
 * @property string $code Уникальнй код валюты
 * @property string $name Название валюты
 *
 * @mixin Builder|BetCurrency|BetCurrency[]
 */
class BetCurrency extends Model
{
    /** @var int ID BTC валюты */
    const BTC = 1;

    /** @var string Код BTC валюты */
    const CODE_BTC = 'BTC';

    /**
     * Количество секунд,
     * в течение которых кешируются курсы,
     * полученные от сторонних сервисов
     *
     * @var int
     */
    const RATES_CACHING_TIME_IN_SECONDS = 10;

    /** @inheritDoc */
    protected $table = 'graybull_bet_currencies';

    /** @inheritDoc */
    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Получить курс валюты к USD
     *
     * @param string $code
     * @return float
     */
    public static function getExchangeRate(string $code): float
    {
        if (!in_array($code, ['btc', 'eth', 'pzm'], true)) {
            throw new \InvalidArgumentException('Invalid exchange code');
        }

        $cacheTime = now(config('graybull.timezone'))
            ->addSeconds(self::RATES_CACHING_TIME_IN_SECONDS);

        return Cache::remember("graybull:{$code}_rate", $cacheTime, function () use ($code) {
            $httpClient = new HttpClient;
            $response = $httpClient->get(config("graybull.current_rate_{$code}"));
            $responseData = json_decode($response->getBody(), true);

            return $responseData['USD'];
        });
    }

    /**
     * Получить курс BTC к USD
     *
     * @return float
     */
    public static function getBtcRate(): float
    {
        return self::getExchangeRate('btc');
    }

    /**
     * Получить историю курса BTC к USD
     *
     * @return array
     */
    public static function geHistoricalBtcRates(): array
    {
        $cacheTime = now(config('graybull.timezone'))
            ->addSeconds(self::RATES_CACHING_TIME_IN_SECONDS);

        return Cache::remember('graybull:last_btc_rates', $cacheTime, function () {
            $httpClient = new HttpClient;
            $response = $httpClient->get(config('graybull.historical_rate_btc_minute_pair'));
            $responseData = json_decode($response->getBody(), true);

            $data = [];

            foreach ($responseData['Data']['Data'] ?? [] as &$datum) {
                $data[] = [
                    $datum['time'] * 1000,
                    $datum['open'],
                    $datum['high'],
                    $datum['low'],
                    $datum['close'],
                    $datum['volumeto'],
                ];

                unset($datum);
            }

            return $data;
        });
    }
}
