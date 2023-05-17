<?php

use Illuminate\Database\Seeder;

class BuyPartnersMapSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('buy_partners_map_settings')->insertOrIgnore([
            0 => [
                'id' => 1,
                'price' => 10,
                'title' => '{"ru":"\u041c\u0435\u0441\u0442\u043e \u043d\u0430 \u043a\u0430\u0440\u0442\u0435 \u043f\u0430\u0440\u0442\u043d\u0451\u0440\u043e\u0432","en":"Place on the map of partners"}',
                'text_info' => '{"ru":"\u0412\u0430\u043c \u0434\u043e\u0441\u0442\u0443\u043f\u043d\u043e \u043c\u0435\u0441\u0442\u043e \u043d\u0430 \u043a\u0430\u0440\u0442\u0435 \u043f\u0430\u0440\u0442\u043d\u0451\u0440\u043e\u0432. \u041e\u0441\u0442\u0430\u0432\u044c\u0442\u0435 \u0437\u0430\u044f\u0432\u043a\u0443 \u043d\u0438\u0436\u0435.","en":"You have access to a place on the map of partners. Leave your request below."}',
                'level' => 6
            ]
        ]);

        echo "Rows: $rows\n";
    }
}
