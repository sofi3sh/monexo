<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Consts\WalletsTypesConsts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsTypesConsts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsTypesConsts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsTypesConsts query()
 * @mixin \Eloquent
 */
class WalletsTypesConsts extends Model
{
    /**
     * @var integer id типа кошелька "Для ввода"
     */
    const INVEST_WALLET_TYPE_ID = 1;

    /**
     * @var integer id типа кошелька "Для вывода"
     */
    const WITHDRAWAL_WALLET_TYPE_ID = 2;

    /**
     * @var integer id типа кошелька "Указанный вручную при создании транзакции"
     */
    const MANUAL_INVEST_WALLET_TYPE_ID = 3;
}
