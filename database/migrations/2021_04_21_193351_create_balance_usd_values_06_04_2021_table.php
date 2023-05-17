<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceUsdValues06042021Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("
      CREATE TABLE balance_usd_values_06_04_2021 AS
      (
        SELECT id as `user_id`, balance_usd
        FROM users
        WHERE 1
      )
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS balance_usd_values_06_04_2021');
    }
}
