<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCryptoAmountsToGraybullBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graybull_bets', function (Blueprint $table) {
            $table->decimal('amount_pzm', 15, 8)->default(0)->after('amount_usd')->comment('Сумма ставки в PZM');
            $table->decimal('amount_eth', 15, 8)->default(0)->after('amount_usd')->comment('Сумма ставки в ETH');
            $table->decimal('amount_btc', 15, 8)->default(0)->after('amount_usd')->comment('Сумма ставки в BTC');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('graybull_bets', function (Blueprint $table) {
            $table->dropColumn('amount_btc');
            $table->dropColumn('amount_eth');
            $table->dropColumn('amount_pzm');
        });
    }
}
