<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Consts\GlobalStatisticsConstants
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\GlobalStatisticsConstants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\GlobalStatisticsConstants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\GlobalStatisticsConstants query()
 * @mixin \Eloquent
 */
class GlobalStatisticsConstants extends Model
{
    /**
     * @var integer id статистики "Сколько людей на проекте"
     */
    const USERS_COUNT_ID = 1;

    /**
     * @var integer id статистики "Общий депозит"
     */
    const DEPOSIT_ID = 2;

    /**
     * @var integer id статистики "Сколько в сумме мы дали дохода"
     */
    const PROFIT_ID = 3;

    /**
     * @var integer id статистики "Сколько мы выплатили денег"
     */
    const WITHDRAWAL_ID = 4;
}
