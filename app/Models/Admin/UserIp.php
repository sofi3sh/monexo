<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class UserIp extends Model
{
    protected $table = 'user_ips';

    protected $fillable = [
        'user_id',
        'ip_registration',
        'ip_last_auth',
        'platform_id',
        'browser_id',
        'device_id'
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::Class, 'user_id', 'id');
    }

    public function browser(): BelongsTo
    {
        return $this->BelongsTo(UserIpBrowser::Class, 'browser_id', 'id');
    }

    public function platform(): BelongsTo
    {
        return $this->BelongsTo(UserIpPlatform::Class, 'platform_id', 'id');
    }

    public function device(): BelongsTo
    {
        return $this->BelongsTo(UserIpDevice::Class, 'device_id', 'id');
    }


}
