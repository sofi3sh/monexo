<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\Balance
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $balance_type_id id типа баланса
 * @property float $balance Сумма баланса
 * @property int $currency_id id валюты баланса
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereBalanceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereUserId($value)
 * @mixin \Eloquent
 */
class Balance extends Model
{
    protected $fillable = ['user_id', 'balance_type_id', 'balance', 'currency_id'];

    protected $table = 'balances';

}
