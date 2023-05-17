<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerifTypes extends Model
{
    // 1 - неактивный выбор,  если выбор на этом элементе - анкета не верифицируется
    const NOT_DEFINED = 1;

    // 2 - клиент с мультиаккаунтом
    const MULTI_ACCOUNT = 2;

    // 3 - клиент, который заработал более 100% от вложенных средств
    const GET_MORE_100_FROM_INVEST = 3;
    
    // 4 - заработал 0% от суммы инвестиций
    const GET_MORE_0_FROM_INVEST = 4;

    // 5 - заработал менее 50% от суммы инвестиций
    const GET_LESS_50_FROM_INVEST = 5;
    
    // 6 - заработал от 50 до 100% от суммы инвестиций.
    const GET__50_100_FROM_INVEST = 6;
}
