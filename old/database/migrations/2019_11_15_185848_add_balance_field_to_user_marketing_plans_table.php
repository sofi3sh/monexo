<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBalanceFieldToUserMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            $table->float('balance_usd')->after('invested_usd')->comment('Текущий баланс на маркетинговом плане');
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
            //
        });
    }
}
