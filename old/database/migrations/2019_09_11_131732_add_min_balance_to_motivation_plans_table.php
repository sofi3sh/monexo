<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMinBalanceToMotivationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motivation_plans', function (Blueprint $table) {
            $table->float('min_balance', 8, 2)
                ->after('min_invest_sum')
                ->comment('Минимальный баланс для покупки плана');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motivation_plans', function (Blueprint $table) {
            $table->dropColumn('min_invest_sum');
        });
    }
}
