<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateCryptocurrencyExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptocurrency_exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->comment('Название биржи');
            $table->string('sub_uri')->unique()->comment('Часть ссылки, обозначающая биржу для чтения курсов');
            $table->boolean('in_arbitrage_trading')->default(true)->comment('Флаг, что биржа участвует в арбитражной торговле');
            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('cryptocurrency_exchanges', 'Криптовалютные биржи');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cryptocurrency_exchanges');
    }
}
