<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletsTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('wallets_types')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'name' => 'Кошелек для ввода средств',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            1 =>
                [
                    'id' => 2,
                    'name' => 'Кошелек для вывода средств',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            2 =>
                [
                    'id' => 3,
                    'name' => 'Вручную вставленный при вводе',
                    'created_at' => '2019-07-06 05:42:00',
                    'updated_at' => '2019-07-06 05:42:00',
                    'deleted_at' => null,
                ],
        ]);

        echo "Rows: $rows\n";
    }
}
