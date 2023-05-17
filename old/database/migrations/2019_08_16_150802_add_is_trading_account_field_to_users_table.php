<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsTradingAccountFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_trading_account')
                ->default(false)
                ->after('yandexMoney')
                ->comment('Признак трейдинг-аккаунта (на котором доступна арбитражная торговля)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'is_trading_account')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_trading_account');
            });
        };
    }
}
