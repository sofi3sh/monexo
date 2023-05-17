<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCryptosToMarketingPlanPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plan_partners', function (Blueprint $table) {
            $table->decimal('invested_eth', 15, 8)->default(0)->after('invested_usd');
            $table->decimal('invested_btc', 15, 8)->default(0)->after('invested_usd');
            $table->decimal('invested_pzm', 15, 2)->default(0)->after('invested_usd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketing_plan_partners', function (Blueprint $table) {
            Schema::dropIfExists('invested_eth');
            Schema::dropIfExists('invested_btc');
            Schema::dropIfExists('invested_pzm');
        });
    }
}
