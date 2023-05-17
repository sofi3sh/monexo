<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExecutedArbitrageCountToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->smallInteger('executed_arbitrage_count')->default(0)
                ->after('yandexMoney')
                ->comment('Количество выполненных арбитражных торгов за сутки');
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
                $table->dropColumn('executed_arbitrage_count');
            });
        };
    }
}
