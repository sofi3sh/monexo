<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCryptocurrencyExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cryptocurrency_exchanges', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191)->unique()->comment('Название биржи');
			$table->string('sub_uri', 191)->unique()->comment('Часть ссылки, обозначающая биржу для чтения курсов');
			$table->boolean('in_arbitrage_trading')->default(1)->comment('Флаг, что биржа участвует в арбитражной торговле');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cryptocurrency_exchanges');
	}

}
