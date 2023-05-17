<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BalanceTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('balance_types')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'comment' => 'Основной баланс',
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
            1 =>
                [
                    'id' => 2,
                    'comment' => 'Инвестировано в коин',
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
        ]);

        echo "Rows: $rows\n";
    }
}
