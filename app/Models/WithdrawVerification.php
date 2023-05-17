<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WithdrawVerification
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereUserId($value)
 * @mixin \Eloquent
 */
class WithdrawVerification extends Model
{
    protected $guarded = [];
    protected $table='withdraw_verifications';
}
