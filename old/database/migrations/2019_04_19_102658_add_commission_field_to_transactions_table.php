<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommissionFieldToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('commission', 4, 2)
                ->default(0)
                ->after('rate')
                ->comment = "Комиссия операции (сумма операции указана без комиссии).";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transactions', 'commission')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn('commission');
            });
        }
    }
}
