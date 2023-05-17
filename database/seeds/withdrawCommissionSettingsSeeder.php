<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WithdrawCommissionSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('withdraw_commission_settings')->insertOrIgnore([
            0 => [
                'id' => 1,
                'period' => 7,
                'commission' => 4.9,
                'created_at' => Carbon::now()
            ],
            1 => [
                'id' => 2,
                'period' => 14,
                'commission' => 3.2,
                'created_at' => Carbon::now()
            ],
            2 => [
                'id' => 3,
                'period' => 30,
                'commission' => 2.6,
                'created_at' => Carbon::now()
            ],
            3 => [
                'id' => 4,
                'period' => 0,
                'commission' =>  1.3,
                'created_at' => Carbon::now()
            ]
        ]);

        echo "Rows: $rows\n";
    }
}
