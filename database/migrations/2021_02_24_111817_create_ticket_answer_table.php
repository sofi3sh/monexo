<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_id')->comment('Ссылка на тикет');
            $table->string('answer', 65535)->comment('Ответ на вопрос из тикета');
            $table->unsignedBigInteger('user_id')->comment('Ссылка на пользователя который дал ответ');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('ticket');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_answer');
    }
}
