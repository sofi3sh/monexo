<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('theme', 255)->comment('Тема обращения');
            $table->unsignedBigInteger('appeal_id')->comment('Ссылка на тип обращения');
            $table->string('question', 65535)->comment('Текст обращения');
            $table->unsignedBigInteger('user_id')->comment('Автор сообщения');
            $table->unsignedBigInteger('ticket_status_id')->comment('Статус');
            $table->timestamps();

            $table->foreign('appeal_id')->references('id')->on('appeal');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ticket_status_id')->references('id')->on('ticket_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}
