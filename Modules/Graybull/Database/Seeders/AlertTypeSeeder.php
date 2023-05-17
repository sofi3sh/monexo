<?php

namespace Modules\Graybull\Database\Seeders;

use App\Models\Consts\AlertType;
use Illuminate\Database\Seeder;

class AlertTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = AlertType::insertOrIgnore([
            [
                'id' => AlertType::GRAYBULL_REFERRAL_BONUS,
                'message_ru' => 'Реферальный бонус Graybull',
                'message_en' => 'Graybull referral bonus',
            ],
            [
                'id' => AlertType::GRAYBULL_BET_OPENING,
                'message_ru' => 'Открытие ставки Graybull',
                'message_en' => 'Opening a bet Graybull',
            ],
            [
                'id' => AlertType::GRAYBULL_PAYMENT,
                'message_ru' => 'Выплата Graybull',
                'message_en' => 'Graybull payment',
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
