<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Accrual
 *
 * @property int $id
 * @property float $percent Начисленный процент
 * @property float|null $percent_month Месячный процент
 * @property string|null $meta Дополнительные данные начисления.
 * @property string $start Начали начисления
 * @property string $end Закончили начисления
 * @property string|null $comment Комментарий к начислению.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual wherePercentMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Accrual extends Model
{
    protected $fillable = [
        'percent', 'percent_month', 'meta', 'start', 'end', 'comment',
    ];
}
