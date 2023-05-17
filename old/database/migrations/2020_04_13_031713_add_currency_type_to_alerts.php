<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrencyTypeToAlerts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->enum('currency_type', ['usd', 'btc', 'eth', 'pzm'])->default('usd')->after('currency_id');
            $table->integer('marketing_plan_id')->nullable()->after('currency_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alerts', function (Blueprint $table) {
            Schema::dropIfExists('currency_type');
            Schema::dropIfExists('marketing_plan_id');
        });
    }
}
