<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeMarketingPlansWithdrawalCommissionType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            DB::statement("ALTER TABLE `marketing_plans` CHANGE `withdrawal_commission` `withdrawal_commission` DECIMAL(5,2) NULL DEFAULT NULL COMMENT 'Комиссия на вывод';");
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
            DB::statement("ALTER TABLE `marketing_plans` CHANGE `withdrawal_commission` `withdrawal_commission` DECIMAL(3,2) NULL DEFAULT NULL COMMENT 'Комиссия на вывод';");
        });
    }
}
