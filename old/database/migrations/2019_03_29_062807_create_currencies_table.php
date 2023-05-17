<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->comment = "Название валюты.";
            $table->string('code')->comment = "Обозначение валюты.";
            $table->smallInteger('rate_decimal_digits')->comment = "Кол-во десятичных разрядов в курсе валюты.";
            $table->boolean('invest_allowed')
                ->default(true)
                ->comment = "Разрешено использовать для ввода.";
            $table->boolean('withdrawal_allowed')
                ->default(true)
                ->comment = "Разрешено использовать для вывода.";

            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('currencies', 'Справочник валют.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
