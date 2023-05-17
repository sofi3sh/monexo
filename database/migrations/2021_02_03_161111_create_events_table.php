<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->comment('Название события');
            $table->dateTime('start')->comment('Дата и время события');
            $table->string('presenter', 191)->comment('Ведущий события');
            $table->string('duration', 191)->comment('Длительность события');
            $table->text('details')->comment('Детали события');
            $table->float('price')->comment('Стоимость события, usd');
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
        Schema::dropIfExists('events');
    }
}
