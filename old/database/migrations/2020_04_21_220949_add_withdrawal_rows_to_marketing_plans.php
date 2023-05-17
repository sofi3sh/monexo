<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWithdrawalRowsToMarketingPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->boolean('available_for_withdrawal')->default(false)->after('coin_percent')->comment('Доступно к выводу');
            $table->decimal('withdrawal_commission', 3,2)->nullable()->after('coin_percent')->comment('Комиссия на вывод');
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
            $table->dropColumn('available_for_withdrawal');
            $table->dropColumn('withdrawal_commission');
        });
    }
}
