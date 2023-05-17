<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccrualCurrencyIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('accrual_currency_id')
                ->nullable(true)
                ->after('bonuses_usd')
                ->comment('id криптовалюты в которой выполнять начисления');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'accrual_currency_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('accrual_currency_id');
            });
        };
    }
}
