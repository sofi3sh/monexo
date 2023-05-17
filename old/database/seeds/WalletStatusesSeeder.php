<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class WalletStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallet_statuses')->insert([
                [
                    'id'         => 1,
                    'name_ru'    => 'Подтвердить перевод средств',
                    'name_en'    => 'Confirm transfer of funds',
                    'name_de'    => 'Überweisung bestätigen',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 2,
                    'name_ru'    => 'Ожидает подтверждения',
                    'name_en'    => 'Awaiting confirmation',
                    'name_de'    => 'Warten auf Bestätigung',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]
        );
    }
}
