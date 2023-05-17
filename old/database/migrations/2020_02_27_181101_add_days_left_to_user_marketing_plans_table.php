<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDaysLeftToUserMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            $table->integer('days_left')->default(0)->comment('Остаток дней работі инвест плана');
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
            $table->dropColumn('paid');
        });
    }
}
