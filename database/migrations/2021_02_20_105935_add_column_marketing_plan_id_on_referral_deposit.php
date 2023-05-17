<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMarketingPlanIdOnReferralDeposit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_deposit', function (Blueprint $table) {
            $table->bigInteger('marketing_plan_id')
                ->after('currency')
                ->comment('Ссылка на пакет');
        });

        Schema::table('referral_deposit', function (Blueprint $table) {
            $table->string('marketing_plan_descr', 255)
                ->after('marketing_plan_id')
                ->comment('Тестовое наименование пакета и сумма строкой');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('referral_deposit', 'marketing_plan_id')) {
            Schema::table('referral_deposit', function (Blueprint $table) {
                $table->dropColumn('marketing_plan_id');
            });
        }

        if (Schema::hasColumn('referral_deposit', 'marketing_plan_descr')) {
            Schema::table('referral_deposit', function (Blueprint $table) {
                $table->dropColumn('marketing_plan_descr');
            });
        }
    }
}
