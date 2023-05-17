<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Home\MotivationPlanParam;

/**
 * App\Models\Home\MotivationPlan
 *
 * @property int $id
 * @property string $name Название плана
 * @property float $price Цена плана
 * @property float $min_invest_sum Минимально инвестированная сумма для покупки плана
 * @property float $min_balance Минимальный баланс для покупки плана
 * @property float $min_withdrawal Минимальный вывод
 * @property float $withdrawal_commission_percent Комиссия вывода, %
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Home\MotivationPlanParam[] $params
 * @property-read int|null $params_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereMinBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereMinInvestSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereMinWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereWithdrawalCommissionPercent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlan withoutTrashed()
 * @mixin \Eloquent
 */
class MotivationPlan extends Model
{
    use SoftDeletes;

    /**
     * Параметры плана мотивации
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function params()
    {
        return $this->hasMany('App\Models\Home\MotivationPlanParam');
    }

    /**
     * Первые начисления по новому мотивационному плану
     *
     * @return mixed
     */
    /*public function firstAccrualPlanParams()
    {
        return MotivationPlanParam::where('motivation_plan_id', $this->id)->orderBy('month_number')->first();
    }*/
}
