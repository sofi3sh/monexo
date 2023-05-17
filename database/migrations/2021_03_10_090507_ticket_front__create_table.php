<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketFrontCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_front', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name', 255)->comment('Имя гостя');
            $table->string('email', 255)->nullable()->comment('email гостя');
            $table->string('phone', 32)->nullable()->comment('Телефон');
            $table->string('question', 4096)->nullable()->comment('Вопрос');
            $table->string('answer', 4096)->nullable()->comment('Ответ');
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
        Schema::dropIfExists('ticket_front');
    }
}
