<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelatedUserWalletIdFieldToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('related_user_wallet_id')
                ->nullable(true)
                ->after('related_user_id')
                ->comment('Связанный виртуальный криптокошелек.');

            $table->foreign('related_user_wallet_id')->references('id')->on('user_wallets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transactions', 'related_user_wallet_id')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn('is_trading_account');
            });
        };
    }
}
