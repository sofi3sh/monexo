<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Consts\WalletsStatusesConsts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsStatusesConsts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsStatusesConsts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsStatusesConsts query()
 * @mixin \Eloquent
 */
class WalletsStatusesConsts extends Model
{
    /**
     * @var integer id типа кошелька "Нормальное (обычное) состояние"
     */
    const NORMAL_STATUS_TYPE_ID = 1;

    /**
     * @var integer id типа состояния кошелька "Ожидает пополнения"
     */
    const WAITING_INVEST_STATUS_TYPE_ID = 2;
}
