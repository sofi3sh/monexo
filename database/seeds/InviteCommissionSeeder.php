<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InviteCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('invite_commission')->insertOrIgnore([
            [
                'id'            => 1,
                'commission'    => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
