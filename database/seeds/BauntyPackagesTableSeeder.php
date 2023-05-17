<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BauntyPackagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('baunty_packages')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'name' => '№1 Bounty-контракт / $100',
                    'created_at' => null,
                    'updated_at' => null,
                ],
            1 =>
                [
                    'id' => 2,
                    'name' => '№2 Bounty-контракт / $150
',
                    'created_at' => null,
                    'updated_at' => null,
                ],
            2 =>
                [
                    'id' => 3,
                    'name' => '№3 Bounty-контракт / $250',
                    'created_at' => null,
                    'updated_at' => null,
                ],
        ]);

        echo "Rows: $rows\n";
    }
}
