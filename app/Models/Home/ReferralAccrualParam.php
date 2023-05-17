<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\ReferralAccrualParam
 *
 * @property int $id
 * @property int $level Уровень реферала.
 * @property int $transaction_type_id id типа транзакции
 * @property int $percent Процент от дохода реферала конкретного уровня, который получает рефер.
 * @property int $accrue Надо ли начислять прибыль по данному уровню.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereAccrue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReferralAccrualParam extends Model
{
    //
}
