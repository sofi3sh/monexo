<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEndPeriodFieldToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dateTime('end_period')
                ->nullable()
                ->useCurrent()
                ->after('rate')
                ->comment = "Дата до которой нельзя выводить средства (т.е. до которой средства не доступны).";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transactions', 'end_period')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn('end_period');
            });
        }
    }
}
