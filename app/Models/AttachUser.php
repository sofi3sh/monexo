<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachUser extends Model
{
    protected $table = 'attached_users';

    protected $fillable = [
        'attach_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function attach()
    {
        return $this->belongsTo(User::class, 'attach_id');
    }


}
