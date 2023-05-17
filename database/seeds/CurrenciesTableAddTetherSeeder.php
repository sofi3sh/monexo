<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableAddTetherSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('currencies')->insertOrIgnore([
                [
                    'id' => 29,
                    'name' => 'Tether',
                    'code' => 'USDT',
                    'rate_decimal_digits' => 8,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2023-03-01 14:54:38',
                    'updated_at' => '2023-03-01 14:54:38',
                    'deleted_at' => null,
                ],
            
        ]);

        echo "Rows: $rows\n";
    }
}
