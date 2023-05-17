<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakeUser extends Model
{
    protected $table = 'fakes_users';
    protected $fillable = [
        'user_id',
        'fake_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function fake() {
        return $this->belongsTo(User::class, 'fake_id');
    }


}
