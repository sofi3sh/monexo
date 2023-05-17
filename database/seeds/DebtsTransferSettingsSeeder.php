<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DebtsTransferSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('debts_transfer_settings')->insertOrIgnore([
            0 => [
                'id' => 1,
                'min' => 20,
                'percent' => 0.02,
                'created_at' => Carbon::now(),
            ]
        ]
    );
    }
}
