<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Home\Wallet
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $currency_id id криптовалюты
 * @property string $address Адрес кошелька.
 * @property string|null $additional_data Дополнительные данные кошелька.
 * @property int $wallet_type_id id типа кошелька
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Wallet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereWalletTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Wallet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Wallet withoutTrashed()
 * @mixin \Eloquent
 */
class Wallet extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'wallet_type_id', 'currency_id', 'address', 'additional_data'];

    protected $dates = ['deleted_at'];

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Home\Currency');
    }

}
