<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NewsSubscribesSettingsSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('news_subscribes_settings')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'week_day' => 1,
                    'month_day' => 1,
                    'week_dispatch_time' => '14:00:00',
                    'month_dispatch_time' => '18:00:00',
                    'created_at' => Carbon::now(),
                ],
        ]);

        echo "Rows: $rows\n";
    }
}
