<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccrualPeriodColumnInMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->integer('accrual_period')->default(1)->after('body_on') ->comment('Период начисления в днях');
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
            $table->dropColumn('accrual_period');
        });
    }
}
