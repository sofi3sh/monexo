<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level')->comment('Уровни');
            $table->decimal('bonus', 15,2)->comment('Бонус');
            $table->decimal('personal_deposit', 15,2)->comment('Личный депозит');
            $table->decimal('team_turnover', 15,2)->comment('Оборот 1-й линии');
            $table->decimal('invitation_deposit', 15,2)->default(0)->comment('Пригласительный депозит');
            $table->decimal('matching_bonus', 3,2)->default(0)->comment('Матчинг бонус');
            $table->integer('affiliate_magnet')->default(0)->comment('Партнёрский магнит');
            $table->boolean('fast_start')->default(false)->comment('Быстрый старт');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonuses');
    }
}
