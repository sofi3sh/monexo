<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('currency_id')->unsigned()->comment('id валюты');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->decimal('rate', 15, 8)->comment('Курс валюты к доллару.');
            $table->decimal('trend', 8, 2)->comment('% изменения курса за последние сутки.');
            $table->timestamps();
        });

        MigrationHelper::addCommentToTable('rates', 'Курсы валют.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
