<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStopAtToUserMarketingPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            $table->dateTime('stop_at')->after('start_at')->nullable()->comment('Дата остановки пакета пользователем');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            $table->dropColumn('stop_at');
        });
    }
}
