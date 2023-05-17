<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Home\UserReferralsUsd
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserReferralsUsd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserReferralsUsd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserReferralsUsd query()
 * @mixin \Eloquent
 */
class UserReferralsUsd extends Model
{
    protected $fillable = ['user_id', 'marketing_plan_id', 'profit', 'level', 'date'];
}
