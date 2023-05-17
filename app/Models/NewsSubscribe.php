<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class NewsSubscribe extends Model
{
    protected $fillable = ['email', 'user_id', 'period'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
