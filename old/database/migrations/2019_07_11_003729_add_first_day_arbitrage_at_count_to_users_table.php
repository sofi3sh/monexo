<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstDayArbitrageAtCountToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('first_day_arbitrage_at')
                ->nullable(true)
                ->after('executed_arbitrage_count')
                ->comment('Время выполнения первого арбитража за предыдущие сутки.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'executed_arbitrage_count')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('first_day_arbitrage_at');
            });
        };
    }
}
