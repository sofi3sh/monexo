<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPurchaseDateInBuyPartnersMapAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_partners_map_apps', function (Blueprint $table) {
            $table->timestamp('purchase_date')->comment('Дата последней покупки подписки');
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
            $table->dropColumn('purchase_date');
        });
    }
}
