<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMarketingParapmsFieldsToMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->integer('first_days_count_for_simple_percent')
                ->after('max_duration')
                ->comment('Кол-во первых дней, когда начисляются простые проценты.');

            $table->float('simple_percent', 5, 2)
                ->after('first_days_count_for_simple_percent')
                ->comment('Величина простых процентов, которые начисляются первые дни.');

            $table->float('max_first_days_profit', 10, 2)
                ->after('first_days_count_for_simple_percent')
                ->comment('Максимальная прибыль первых дней.');
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
            //
        });
    }
}
