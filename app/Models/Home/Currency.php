<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Models\Home\Currency
 *
 * @property int $id
 * @property string $name Название валюты.
 * @property string $code Обозначение валюты.
 * @property int $rate_decimal_digits Кол-во десятичных разрядов в курсе валюты.
 * @property int $invest_allowed Разрешено использовать для ввода.
 * @property int $withdrawal_allowed Разрешено использовать для вывода.
 * @property int $show_rate_on_landing Признак, надо или нет показывать этот курс на лендинге.
 * @property int $is_crypto Признак, что это криптовалюта. Пошли костыли, чтобы подключить плат. системы.
 * @property int $in_arbitrage_trading Признак, что криптовалюта доступна в арбитражной торговле.
 * @property string|null $blockchain_addr Адрес блокчена для проверки транзакции.
 * @property float $withdrawal_commission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency allowedForWithdrawalCrypto()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency allowedForWithdrawalPaymentSystems()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Currency onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereBlockchainAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereInArbitrageTrading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereInvestAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereIsCrypto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereRateDecimalDigits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereShowRateOnLanding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereWithdrawalAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereWithdrawalCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Currency withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Currency withoutTrashed()
 * @mixin \Eloquent
 */
class Currency extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'currencies';

    /**
     * Возвращает криптовалюты, на которые можно выполнять вывод
     *
     * @return Collection
     */
    public static function allowedForWithdrawalCurrencies(): Collection
    {
        return Currency::AllowedForWithdrawalCrypto()->get();
    }

    /**
     * Возвращает платежные системы, на которые можно выполнять вывод
     *
     * @return Collection
     */
    public static function getAllowedForWithdrawalPaymentSystems(): Collection
    {
        return Currency::AllowedForWithdrawalPaymentSystems()->get();
    }

    /**
     * scope Криптовалюты, на которые можно выполнять вывод.
     *
     * @param $query
     * @return mixed
     */
    public function scopeAllowedForWithdrawalCrypto($query)
    {
        return $query
            ->where('withdrawal_allowed', true)
            ->where('is_crypto', true);
    }

    public function getNameAttribute($value) {
        if(strpos($value, '.') !== false) // Если в имени валюты есть точка, то она переводится
        {
            return __($value);
        }
        return $value;
    }

    /**
     * scope Платежные системы, на которые можно выполнять вывод.
     *
     * @param $query
     * @return mixed
     */
    public function scopeAllowedForWithdrawalPaymentSystems($query)
    {
        return $query
            ->where('withdrawal_allowed', true)
            ->where('is_crypto', false);
    }
}
