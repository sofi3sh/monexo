<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\VerifyWithdrawal
 *
 * @property int $id
 * @property int $user_id
 * @property int $currency_id
 * @property string $token
 * @property float|null $amount
 * @property string $address
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereUserId($value)
 * @mixin \Eloquent
 */
class VerifyWithdrawal extends Model
{
    public function currency()
    {
        return $this->belongsTo('App\Models\Home\Currency');
    }
}
