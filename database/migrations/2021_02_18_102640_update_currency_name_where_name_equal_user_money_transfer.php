<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateCurrencyNameWhereNameEqualUserMoneyTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            DB::update('UPDATE currencies SET name="base.currency.money-transfer" WHERE name="User money transfer"');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currencies', function (Blueprint $table) {
            DB::update('UPDATE currencies SET name="User money transfer" WHERE name="base.currency.money-transfer"');
        });
    }
}
