<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrencyTypeToMarketingPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->enum('currency_type', ['usd', 'btc', 'eth', 'pzm'])->default('usd')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            Schema::dropIfExists('currency_type');
        });
    }
}
