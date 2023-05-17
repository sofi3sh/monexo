<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivationPlansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('motivation_plans')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'name' => 'Test 1',
                    'price' => 500.0,
                    'min_invest_sum' => 500.0,
                    'min_balance' => 0.0,
                    'min_withdrawal' => 500.0,
                    'withdrawal_commission_percent' => 10.0,
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
            1 =>
                [
                    'id' => 2,
                    'name' => 'Test 2',
                    'price' => 500.0,
                    'min_invest_sum' => 500.0,
                    'min_balance' => 0.0,
                    'min_withdrawal' => 500.0,
                    'withdrawal_commission_percent' => 10.0,
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
            2 =>
                [
                    'id' => 3,
                    'name' => 'Test 3',
                    'price' => 500.0,
                    'min_invest_sum' => 500.0,
                    'min_balance' => 0.0,
                    'min_withdrawal' => 500.0,
                    'withdrawal_commission_percent' => 10.0,
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
            3 =>
                [
                    'id' => 4,
                    'name' => 'Test 4',
                    'price' => 500.0,
                    'min_invest_sum' => 500.0,
                    'min_balance' => 0.0,
                    'min_withdrawal' => 500.0,
                    'withdrawal_commission_percent' => 10.0,
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
        ]);

        echo "Rows: $rows\n";
    }
}
