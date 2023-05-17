<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PasswordSecurity
 *
 * @property int $id
 * @property int $user_id
 * @property int $google2fa_enable
 * @property string|null $google2fa_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereGoogle2faEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereGoogle2faSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereUserId($value)
 * @mixin \Eloquent
 */
class PasswordSecurity extends Model
{
    protected $guarded = [];
}
