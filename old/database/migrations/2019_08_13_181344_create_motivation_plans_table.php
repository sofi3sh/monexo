<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivation_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Название плана');
            $table->float('price', 8, 2)->comment('Цена плана');
            $table->float('min_invest_sum', 8, 2)->comment('Минимально инвестированная сумма для покупки плана');
            $table->float('min_withdrawal', 8, 2)->comment('Минимальный вывод');
            $table->float('withdrawal_commission_percent', 8, 2)->comment('Комиссия вывода, %');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivation_plans');
    }
}
