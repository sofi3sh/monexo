<?php

namespace Modules\Graybull\Database\Seeders;

use App\Models\Home\TransactionType;
use App\Models\Consts\TransactionsTypesConsts;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = TransactionType::insertOrIgnore([
            [
                'id' => TransactionsTypesConsts::GRAYBULL_BET_OPENING,
                'name_ru' => 'Открытие ставки Graybull',
                'name_en' => 'Opening a bet Graybull',
                'name_de' => 'Opening a bet Graybull',
                'name_zh' => 'Opening a bet Graybull',
                'name_fr' => 'Opening a bet Graybull',
                'name_pl' => 'Opening a bet Graybull',
            ],
            [
                'id' => TransactionsTypesConsts::GRAYBULL_PAYMENT,
                'name_ru' => 'Выплата Graybull',
                'name_en' => 'Graybull payment',
                'name_de' => 'Graybull payment',
                'name_zh' => 'Graybull payment',
                'name_fr' => 'Graybull payment',
                'name_pl' => 'Graybull payment',
            ],
            [
                'id' => TransactionsTypesConsts::GRAYBULL_REFERRAL_BONUS,
                'name_ru' => 'Реферальный бонус Graybull',
                'name_en' => 'Graybull referral bonus',
                'name_de' => 'Graybull referral bonus',
                'name_zh' => 'Graybull referral bonus',
                'name_fr' => 'Graybull referral bonus',
                'name_pl' => 'Graybull referral bonus',
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
