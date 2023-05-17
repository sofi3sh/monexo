<?php

use Illuminate\Database\Seeder;

class CustomTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('custom_transactions')->insertOrIgnore([
                0 => [
                    'id' => 1,
                    'min' => 10,
                    'max' => 5000,
                    'commission' => 2.5
                ]
            ]
        );
    }
}
