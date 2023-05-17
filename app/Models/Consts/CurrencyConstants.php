<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Consts\CurrencyConstants
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\CurrencyConstants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\CurrencyConstants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\CurrencyConstants query()
 * @mixin \Eloquent
 */
class CurrencyConstants extends Model
{
    /**
     * @var integer id валюты "USD"
     */
    const USD = 1;
}
