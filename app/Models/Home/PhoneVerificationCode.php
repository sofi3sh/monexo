<?php

namespace App\Models\Home;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneVerificationCode extends Model
{
    protected $table = 'phone_verification_codes';

    protected $fillable = [
        'code',
        'user_id',
        'expiration',
        'is_used',
        'phone',
    ];

    protected $casts = [
        'code' => 'string',
        'user_id' => 'integer',
        'expiration' => 'datetime',
        'is_used' => 'boolean',
        'phone' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
