<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\ReferralAccrualParam
 *
 * @property int $id
 * @property int $level Уровень реферала.
 * @property int $transaction_type_id id типа транзакции
 * @property int $percent Процент от дохода реферала конкретного уровня, который получает рефер.
 * @property int $accrue Надо ли начислять прибыль по данному уровню.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereAccrue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReferralAccrualParam extends Model
{
    //
}
