<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->comment('Имя');
            $table->string('surname', 191)->comment('Фамилия');
            $table->string('city', 191)->nullable()->comment('Город');
            $table->string('phone', 191)->nullable()->comment('Телефон');
            $table->string('telegram', 191)->nullable()->comment('Телеграм');
            $table->text('coordinates')->nullable()->comment('Координаты');
            $table->date('date_birthday')->comment('Дата рождения');
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
        Schema::dropIfExists('partners');
    }
}
