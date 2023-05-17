<?php

use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maps')->insertOrIgnore([
                0 => [
                    'id' => 1,
                    'code' => '<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2ee6e27eedf47454a47181157dbe792eae759646c7084e1fde7db9732167d062&amp;width=100%&amp;height=527&amp;lang=ru&amp;scroll=false"></script>',
                    'show' => false,
                    'created_at' => \Carbon\Carbon::now()
                ]
            ]
        );
    }
}
