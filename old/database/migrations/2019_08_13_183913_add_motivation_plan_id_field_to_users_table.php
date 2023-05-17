<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMotivationPlanIdFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('motivation_plan_id')
                ->nullable(true)
                ->after('first_day_arbitrage_at')
                ->comment('id типа мотивационного плана');

            $table->foreign('motivation_plan_id')->references('id')->on('motivation_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'motivation_plan_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('motivation_plan_id');
            });
        };
    }
}
