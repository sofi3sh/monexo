<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArbitrageTradingPlanIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('arbitrage_trading_plan_id')
                ->nullable(true)
                ->after('yandexMoney')
                ->comment('id активного арбитражного плана пользователя');

            $table->foreign('arbitrage_trading_plan_id')->references('id')->on('arbitrage_trading_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
