<?php


namespace App\Repositories\UserIp;


use App\Models\Admin\UserIp;
use App\Models\User;

interface UserIpRepositoryInterface
{
    public function __construct(UserIp $model);
    public function insertRegister(User $user, string $ip);
    public function insertAuth(User $user, string $ip);
}
