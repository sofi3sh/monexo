<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBalanceCoinsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance_eth', 15, 8)->default(0)->after('balance_usd');
            $table->decimal('balance_btc', 15, 8)->default(0)->after('balance_usd');
            $table->decimal('balance_pzm', 15, 2)->default(0)->after('balance_usd');

            $table->decimal('invested_eth', 15, 8)->default(0)->after('invested_usd');
            $table->decimal('invested_btc', 15, 8)->default(0)->after('invested_usd');
            $table->decimal('invested_pzm', 15, 2)->default(0)->after('invested_usd');

            $table->decimal('invested_eth_to_marketplace', 15, 8)->default(0)->after('invested_usd_to_marketplace');
            $table->decimal('invested_btc_to_marketplace', 15, 8)->default(0)->after('invested_usd_to_marketplace');
            $table->decimal('invested_pzm_to_marketplace', 15, 2)->default(0)->after('invested_usd_to_marketplace');

            $table->decimal('profit_eth', 15, 8)->default(0)->after('profit_usd');
            $table->decimal('profit_btc', 15, 8)->default(0)->after('profit_usd');
            $table->decimal('profit_pzm', 15, 2)->default(0)->after('profit_usd');

            $table->decimal('referrals_eth', 15, 8)->default(0)->after('referrals_usd');
            $table->decimal('referrals_btc', 15, 8)->default(0)->after('referrals_usd');
            $table->decimal('referrals_pzm', 15, 2)->default(0)->after('referrals_usd');


            $table->decimal('withdrawal_eth', 15, 8)->default(0)->after('withdrawal_usd');
            $table->decimal('withdrawal_btc', 15, 8)->default(0)->after('withdrawal_usd');
            $table->decimal('withdrawal_pzm', 15, 2)->default(0)->after('withdrawal_usd');


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
            Schema::dropIfExists('balance_btc');
            Schema::dropIfExists('balance_eth');
            Schema::dropIfExists('balance_pzm');
            Schema::dropIfExists('invested_eth');
            Schema::dropIfExists('invested_btc');
            Schema::dropIfExists('invested_pzm');
            Schema::dropIfExists('invested_eth_to_marketplace');
            Schema::dropIfExists('invested_btc_to_marketplace');
            Schema::dropIfExists('invested_pzm_to_marketplace');
            Schema::dropIfExists('profit_eth');
            Schema::dropIfExists('profit_btc');
            Schema::dropIfExists('profit_pzm');
            Schema::dropIfExists('referrals_eth');
            Schema::dropIfExists('referrals_btc');
            Schema::dropIfExists('referrals_pzm');
            Schema::dropIfExists('withdrawal_eth');
            Schema::dropIfExists('withdrawal_btc');
            Schema::dropIfExists('withdrawal_pzm');
        });
    }
}
