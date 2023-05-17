<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddPercentFieldToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->float('percent', 5, 2)
                ->nullable(true)
                ->after('commission')
                ->comment('Процент транзакции (начисления, комиссии и т.п.)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'percent')) {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->dropColumn('percent');
                });
            }
        });
    }
}
