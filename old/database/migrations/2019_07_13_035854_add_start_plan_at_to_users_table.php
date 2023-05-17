<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartPlanAtToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('start_arbitrage_plan_at')
                ->nullable(true)
                ->after('arbitrage_trading_plan_id')
                ->comment('Дата начала действия арбитражного плана');
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
            if (Schema::hasColumn('users', 'start_arbitrage_plan_at')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('start_arbitrage_plan_at');
                });
            };
        });
    }
}
