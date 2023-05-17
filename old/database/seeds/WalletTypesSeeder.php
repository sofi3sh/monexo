<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class WalletTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallet_types')->insert([
            [
                'id'         => 1,
                'name'       => 'Кошелек для ввода средств',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 2,
                'name'       => 'Кошелек для вывода средств',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
