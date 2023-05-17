<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchangen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('balance_from', 3)->comment('Списать с баланса:');
            $table->decimal('amount_from', 40, 20)->unsigned()->comment('Сумма списываемая с баланса');
            $table->string('balance_to', 3)->comment('Зачислить на баланс');
            $table->decimal('amount_to', 40, 20)->unsigned()->comment('Сумма зачисляемая на баланс');
            $table->decimal('rate', 40, 20)->unsigned()->comment('Курс');
            $table->unsignedInteger('user_id')->comment('id пользователяю Ссылка на users.id');
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchangen');
    }
}
