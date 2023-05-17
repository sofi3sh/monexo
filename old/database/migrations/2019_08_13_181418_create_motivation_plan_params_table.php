<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivationPlanParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivation_plan_params', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('motivation_plan_id')->comment('id типа мотивационного плана');
            $table->smallInteger('month_number')->comment('Номер месяца на который выполняется начисление вознаграждения');
            $table->float('deposit_profit_bonus_percent')->comment('Процент вознаграждения к прибыли от депозита');
            $table->float('referrals_profit_bonus_percent')->comment('Процент вознаграждения к прибыли от рефералов');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('motivation_plan_id')->references('id')->on('motivation_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivation_plan_params');
    }
}
