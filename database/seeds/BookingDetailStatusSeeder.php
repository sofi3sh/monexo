<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingDetailStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('booking_detail_status')->insertOrIgnore([
            ['id' => 1, 'descr_en' => 'white', 'descr_ru' => 'Ожидание', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'descr_en' => 'done', 'descr_ru' => 'Выполнено', 'created_at' => now(), 'updated_at' => now()],
        ]);

        echo "Rows: $rows\n";
    }
}
