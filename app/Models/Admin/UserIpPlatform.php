<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserIpPlatform extends Model
{
    protected $table = 'user_ip_platforms';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function userIp(): HasMany
    {
        return $this->hasMany(UserIp::Class, 'type_id', 'id');
    }
}
