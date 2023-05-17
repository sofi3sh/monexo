<?php

namespace App\Models\Home;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use SoftDeletes;

    protected $table = 'booking';

    protected $fillable = [
        'user_id',
        'contact',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::Class, 'user_id', 'id');
    }
}
