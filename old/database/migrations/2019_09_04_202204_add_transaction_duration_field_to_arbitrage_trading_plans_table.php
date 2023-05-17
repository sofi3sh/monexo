<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionDurationFieldToArbitrageTradingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arbitrage_trading_plans', function (Blueprint $table) {
            $table->integer('transaction_duration')
                ->after('max_sum')
                ->comment('Длительность транзакции торговли, сек.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('arbitrage_trading_plans', 'transaction_duration')) {
            Schema::table('arbitrage_trading_plans', function (Blueprint $table) {
                $table->dropColumn('transaction_duration');
            });
        };
    }
}
