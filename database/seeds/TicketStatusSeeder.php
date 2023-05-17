<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('ticket_status')->insertOrIgnore([
            [
                'id'            => 1,
                'descr'         => 'Новый',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 2,
                'descr'         => 'Активный',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 3,
                'descr'         => 'Закрыт',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
