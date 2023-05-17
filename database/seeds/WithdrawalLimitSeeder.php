<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WithdrawalLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('withdrawal_limits')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'name' => 'card',
                    'value' => 800,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
        ]);

        echo "Rows: $rows\n";
    }
}
