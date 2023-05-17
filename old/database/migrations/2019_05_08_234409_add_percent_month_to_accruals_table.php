<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPercentMonthToAccrualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accruals', function (Blueprint $table) {
            $table->float('percent_month')
                ->nullable(true)
                ->after('percent')
                ->comment('Месячный процент');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accruals', function (Blueprint $table) {
            if (Schema::hasColumn('accruals', 'percent')) {
                Schema::table('accruals', function (Blueprint $table) {
                    $table->dropColumn('percent');
                });
            };
        });
    }
}
