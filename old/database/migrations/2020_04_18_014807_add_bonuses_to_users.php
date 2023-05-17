<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBonusesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('bonus_level')->default(0)->after('bonuses_usd')->comment('Уровень бонусы');
            $table->decimal('bonuses_deposit', 15,2)->default(0)->after('bonuses_usd')->comment('Бонусный депозит');
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
            $table->dropColumn('bonus_level');
            $table->dropColumn('bonuses_deposit');
        });
    }
}
