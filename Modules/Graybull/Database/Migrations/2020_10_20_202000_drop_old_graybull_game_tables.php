<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class DropOldGraybullGameTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('graybull_balance_histories');
       Schema::dropIfExists('graybull_bets');
       Schema::dropIfExists('graybull_game_balances');
       Schema::dropIfExists('graybull_game_purchases');
       Schema::dropIfExists('graybull_packages');
       Schema::dropIfExists('graybull_pay_offs');
       Schema::dropIfExists('graybull_rules');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
