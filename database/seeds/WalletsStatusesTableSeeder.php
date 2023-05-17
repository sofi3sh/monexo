<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletsStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('wallets_statuses')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'name_ru' => 'Подтвердить перевод средств',
                    'name_en' => 'Confirm transfer of funds',
                    'name_de' => 'Überweisung bestätigen',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            1 =>
                [
                    'id' => 2,
                    'name_ru' => 'Ожидает подтверждения',
                    'name_en' => 'Awaiting confirmation',
                    'name_de' => 'Warten auf Bestätigung',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
        ]);

        echo "Rows: $rows\n";
    }
}
