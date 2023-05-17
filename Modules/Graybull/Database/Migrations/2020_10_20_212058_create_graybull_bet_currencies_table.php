<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraybullBetCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graybull_bet_currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique()->comment('Уникальнй код валюты');
            $table->string('name', 128)->comment('Название валюты');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graybull_bet_currencies');
    }
}
