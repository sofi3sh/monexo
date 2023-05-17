<?php

use App\Models\User;
use App\Models\UserVerifTypes;
use Illuminate\Database\Seeder;

class UserVerifTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = UserVerifTypes::query()->insertOrIgnore([
            [
                'id' => UserVerifTypes::NOT_DEFINED,
                'name' => 'Не определено',
            ],
            [
                'id' => UserVerifTypes::MULTI_ACCOUNT,
                'name' => 'Мульти аккаунт',
            ],
            [
                'id' => UserVerifTypes::GET_MORE_100_FROM_INVEST,
                'name' => 'заработал более 100% от вложенных средств'
            ],
            [
                'id' => UserVerifTypes::GET_MORE_0_FROM_INVEST,
                'name' => 'заработал 0% от суммы инвестиций'
            ],
            [
                'id' => UserVerifTypes::GET_LESS_50_FROM_INVEST,
                'name' => 'заработал менее 50% от суммы инвестиций'
            ],
            [
                'id' => UserVerifTypes::GET__50_100_FROM_INVEST,
                'name' => 'заработал от 50 до 100% от суммы инвестиций'
            ]
        ]);
        echo "Rows: $rows\n";
    }
}
