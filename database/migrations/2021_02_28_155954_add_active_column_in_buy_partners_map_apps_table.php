<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveColumnInBuyPartnersMapAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_partners_map_apps', function (Blueprint $table) {
            $table->boolean('is_active')->comment('Указывает на то, хочет ли user продолдать подписку');
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
            $table->dropColumn('is_active');
        });
    }
}
