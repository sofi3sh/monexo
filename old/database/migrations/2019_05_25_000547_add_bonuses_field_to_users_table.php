<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBonusesFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('bonuses_usd', 11, 2)
                ->after('withdrawal_request_usd')
                ->comment('Сумма начисленных бонусов');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'bonuses_usd')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('bonuses_usd');
                });
            };
        });
    }
}
