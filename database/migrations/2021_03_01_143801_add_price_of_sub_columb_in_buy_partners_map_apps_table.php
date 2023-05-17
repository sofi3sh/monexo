<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceOfSubColumbInBuyPartnersMapAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_partners_map_apps', function (Blueprint $table) {
            $table->float('price_of_sub')->comment('Цена подписки (для возврата денег)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_partners_map_apps', function (Blueprint $table) {
            $table->dropColumn('price_of_sub');
        });
    }
}
