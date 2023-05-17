<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDeletedAtForAllPackagesInUserMarketingPlans extends Migration
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
        //         ->whereNull('end_at',)
        //         ->whereNull('deleted_at')
        //         ->update([
        //             'deleted_at' => '2020-04-06 00:00:00'
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

    }
}
