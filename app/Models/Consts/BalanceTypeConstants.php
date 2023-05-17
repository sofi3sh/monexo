<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Consts\BalanceTypeConstants
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\BalanceTypeConstants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\BalanceTypeConstants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\BalanceTypeConstants query()
 * @mixin \Eloquent
 */
class BalanceTypeConstants extends Model
{
    /**
     * @var integer id типа баланса "Основной баланс"
     */
    const MAIN = 1;

    /**
     * @var integer id типа баланса "Баланс инвестирования в коин"
     */
    const INVEST_TO_COIN = 2;
}
