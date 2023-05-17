<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArbitrageTradingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbitrage_trading_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru')->comment('Название плана');
            $table->string('name_en');
            $table->string('name_de');
            $table->string('name_zh');
            $table->string('name_fr');
            $table->string('name_pl');
            $table->float('price', 8, 2)->comment('Стоимость плана');
            $table->smallInteger('duration')->comment('Длительность действия плана, дн.');
            $table->smallInteger('max_operation_count')->comment('Макс. кол-во операций, которые можно проводить за сутки');
            $table->smallInteger('max_sum')->comment('Макс. сумма, которую можно использовать в арбитражной торговле');
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
        Schema::dropIfExists('arbitrage_trading_plans');
    }
}
