<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Job
 *
 * @property int $id
 * @property string $queue
 * @property string $payload
 * @property int $attempts
 * @property int|null $reserved_at
 * @property int $available_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id id связанного с задачей пользователя
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereReservedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereUserId($value)
 * @mixin \Eloquent
 */
class Job extends Model
{
    //
}
