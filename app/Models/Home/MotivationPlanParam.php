<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Home\MotivationPlanParam
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlanParam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlanParam newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlanParam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlanParam query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlanParam withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlanParam withoutTrashed()
 * @mixin \Eloquent
 */
class MotivationPlanParam extends Model
{
    use SoftDeletes;
}
