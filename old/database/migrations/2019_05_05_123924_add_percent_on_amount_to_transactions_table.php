<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPercentOnAmountToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->float('percent_on_amount', 11, 2)
                ->nullable()
                ->after('percent')
                ->comment('От какой суммы брался процент.');
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
            if (Schema::hasColumn('transactions', 'percent_on_amount')) {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->dropColumn('percent_on_amount');
                });
            }
        });
    }
}
