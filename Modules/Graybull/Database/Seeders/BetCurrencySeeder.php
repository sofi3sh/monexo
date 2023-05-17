<?php

namespace Modules\Graybull\Database\Seeders;

use Modules\Graybull\Models\BetCurrency;
use Illuminate\Database\Seeder;

class BetCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = BetCurrency::insertOrIgnore([
            [
                'id' => BetCurrency::BTC,
                'code' => BetCurrency::CODE_BTC,
                'name' => 'Bitcoin',
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
