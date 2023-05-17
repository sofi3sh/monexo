<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEndAtInAllUserMarketingPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('user_marketing_plans', function (Blueprint $table) {
        //     DB::table('user_marketing_plans')
        //         ->whereNull('end_at')
        //         ->update([
        //             'end_at' => '2021-04-06 00:00:00'
        //         ]);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            DB::table('user_marketing_plans')
                ->where('end_at', '2021-04-06 00:00:00')
                ->update([
                    'end_at' => null
                ]);
        });
    }
}
