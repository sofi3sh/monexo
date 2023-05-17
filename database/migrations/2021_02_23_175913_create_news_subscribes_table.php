<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->comment('Email для рассылки');
            $table->enum('period', ['week', 'month'])->comment('Периодичность отправки писем');
            $table->bigInteger('user_id')->unsigned()->nullable()->comment('Id пользователя из таблицы users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('news_subscribes');
    }
}
