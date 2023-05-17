<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Home\ArbitrageTradingPlan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTradingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTradingPlan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTradingPlan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTradingPlan query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTradingPlan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTradingPlan withoutTrashed()
 * @mixin \Eloquent
 */
class ArbitrageTradingPlan extends Model
{
    use SoftDeletes;
}
