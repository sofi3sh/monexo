<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('id пользователя');
            $table->unsignedBigInteger('balance_type_id')->comment('id типа баланса');
            $table->float('balance', 15, 2)->comment('Сумма баланса');
            $table->unsignedBigInteger('currency_id')->comment('id валюты баланса');
            $table->timestamps();

            $table->foreign('balance_type_id')->references('id')->on('balance_types')->onDelete('cascade');
            $table->unique(['user_id', 'balance_type_id', 'currency_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balances');
    }
}
