<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->float('min')->comment('Минимальная сумма перевода');
            $table->float('max')->comment('Максимальная сумма перевода');
            $table->float('commission')->comment('Размер комиссии для перевода');
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
        Schema::dropIfExists('custom_transactions');
    }
}
