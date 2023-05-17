<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBalanceUsdAfterTransactionFieldToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->float('balance_usd_after_transaction', 11, 2)
                ->after('commission')
                ->comment('Баланс пользователя после выполнения данной транзакции.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'balance_usd_after_transaction')) {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->dropColumn('balance_usd_after_transaction');
                });
            }
        });
    }
}
