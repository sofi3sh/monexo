<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserIpDevice extends Model
{
    protected $table = 'user_ip_devices';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function userIp(): HasMany
    {
        return $this->hasMany(UserIp::Class, 'type_id', 'id');
    }
}
