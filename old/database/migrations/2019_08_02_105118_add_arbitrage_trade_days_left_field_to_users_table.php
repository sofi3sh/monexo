<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArbitrageTradeDaysLeftFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->smallInteger('arbitrage_trade_days_left')
                ->nullable(true)
                ->after('start_arbitrage_plan_at')
                ->comment('Доступное (оставшееся) количество дней арбитражной торговли');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'arbitrage_trade_days_left')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('arbitrage_trade_days_left');
            });
        };
    }
}
