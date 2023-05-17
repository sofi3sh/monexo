<?php

use Modules\Graybull\Models\Bet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraybullBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graybull_bets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('ID пользователя');
            $table->unsignedBigInteger('currency_id')->comment('ID валюты');
            $table->enum('status', Bet::ALL_STATUSES)->default(Bet::STATUS_WAIT)->comment('Статус ставки');
            $table->enum('direction', Bet::ALL_DIRECTIONS)->comment('Направление курса валюты');
            $table->decimal('amount_usd', 15, 8)->comment('Сумма ставки в USD');
            $table->decimal('commission_for_opening', 15, 8)->comment('Комиссия за открытие ставки');
            $table->decimal('exchange_rate_at_opening', 15, 8)->comment('Начальный курс валюты');
            $table->decimal('exchange_rate_at_closing', 15, 8)->nullable()->comment('Финальный курс валюты');
            $table->time('duration', 0)->comment('Продолжительность ставки');
            $table->dateTime('opened_at')->comment('Ставка открыта');
            $table->dateTime('closing_at')->nullable()->comment('Ставка должна быть закрыта');
            $table->dateTime('closed_at')->nullable()->comment('Ставка закрыта');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('currency_id')
                ->references('id')
                ->on('graybull_bet_currencies')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graybull_bets');
    }
}
