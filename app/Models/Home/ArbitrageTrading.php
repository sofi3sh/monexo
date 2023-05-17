<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Home\ArbitrageTrading
 *
 * @property-read \App\Models\Home\CryptocurrencyExchange $buyCryptocurrencyExchange
 * @property-read \App\Models\Home\Currency $currency
 * @property-read \App\Models\Home\CryptocurrencyExchange $sellCryptocurrencyExchange
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTrading newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTrading newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTrading onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTrading query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTrading withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTrading withoutTrashed()
 * @mixin \Eloquent
 */
class ArbitrageTrading extends Model
{
    use SoftDeletes;

    public function currency()
    {
        return $this->belongsTo('App\Models\Home\Currency');
    }

    public function buyCryptocurrencyExchange()
    {
        return $this->belongsTo('App\Models\Home\CryptocurrencyExchange');
    }

    public function sellCryptocurrencyExchange()
    {
        return $this->belongsTo('App\Models\Home\CryptocurrencyExchange');
    }

    /**
     * Количество купленной криптовалюты
     *
     * @return float|int
     */
    public function amountBuyOfCryptocurrency()
    {
        return $this->amount_usd / $this->buy_rate;
    }

    /**
     * Сумма продажи криптовалюты в usd
     *
     * @return float|int
     */
    public function amountUsdOfSale()
    {
        return $this->amountBuyOfCryptocurrency() * $this->sell_rate;
    }

    /**
     * Прибыль операции арбитражной торговли (не учитывая комиссию сервиса)
     *
     * @return float|int|mixed
     */
    public function profitUsd()
    {
        return $this->amountUsdOfSale() - $this->amount_usd;
    }

    /**
     * Вычисляет прибыль пользователя с учетом комиссии сервиса
     *
     * @param float $commission
     * @return float|int
     */
    public function calcUserProfitUsd(float $commission)
    {
        return $this->profitUsd() * (100 - $commission) / 100;
    }

}
