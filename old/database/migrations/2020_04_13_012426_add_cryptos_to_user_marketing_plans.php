<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCryptosToUserMarketingPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            $table->decimal('invested_eth', 15, 8)->default(0)->after('invested_usd');
            $table->decimal('invested_btc', 15, 8)->default(0)->after('invested_usd');
            $table->decimal('invested_pzm', 15, 2)->default(0)->after('invested_usd');

            $table->decimal('balance_eth', 15, 8)->default(0)->after('balance_usd');
            $table->decimal('balance_btc', 15, 8)->default(0)->after('balance_usd');
            $table->decimal('balance_pzm', 15, 2)->default(0)->after('balance_usd');

            $table->decimal('profit_eth', 15, 8)->default(0)->after('profit_usd');
            $table->decimal('profit_btc', 15, 8)->default(0)->after('profit_usd');
            $table->decimal('profit_pzm', 15, 2)->default(0)->after('profit_usd');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            Schema::dropIfExists('invested_eth');
            Schema::dropIfExists('invested_btc');
            Schema::dropIfExists('invested_pzm');
            Schema::dropIfExists('balance_eth');
            Schema::dropIfExists('balance_btc');
            Schema::dropIfExists('balance_pzm');
            Schema::dropIfExists('profit_eth');
            Schema::dropIfExists('profit_btc');
            Schema::dropIfExists('profit_pzm');
        });
    }
}
