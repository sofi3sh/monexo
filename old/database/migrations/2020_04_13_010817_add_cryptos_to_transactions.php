<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCryptosToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('amount_eth', 15, 8)->default(0)->after('amount_usd');
            $table->decimal('amount_btc', 15, 8)->default(0)->after('amount_usd');
            $table->decimal('amount_pzm', 15, 2)->default(0)->after('amount_usd');

            $table->decimal('balance_eth_after_transaction', 15, 8)->default(0)->after('balance_usd_after_transaction');
            $table->decimal('balance_btc_after_transaction', 15, 8)->default(0)->after('balance_usd_after_transaction');
            $table->decimal('balance_pzm_after_transaction', 15, 2)->default(0)->after('balance_usd_after_transaction');

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
            Schema::dropIfExists('amount_eth');
            Schema::dropIfExists('amount_btc');
            Schema::dropIfExists('amount_pzm');
            Schema::dropIfExists('balance_eth_after_transaction');
            Schema::dropIfExists('balance_btc_after_transaction');
            Schema::dropIfExists('balance_pzm_after_transaction');
        });
    }
}
