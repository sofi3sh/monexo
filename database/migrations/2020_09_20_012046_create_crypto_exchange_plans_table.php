<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCryptoExchangePlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crypto_exchange_plans', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ru', 191)->comment('Название плана');
			$table->string('name_en', 191);
			$table->string('name_de', 191);
			$table->string('name_zh', 191);
			$table->string('name_fr', 191);
			$table->string('name_pl', 191);
			$table->float('price')->comment('Стоимость плана, usd');
			$table->float('commission_to_crypto')->comment('Комиссия на покупку крипты за фиатные деньги, %');
			$table->float('commission_to_fiat')->comment('Комиссия на покупку фиатных денег за крипту, %');
			$table->integer('number_exchanges_per_period')->comment('Количество допустимых обменов за период');
			$table->integer('period_duration')->comment('Количество дней в периоде');
			$table->integer('plan_duration')->comment('Продолжительность действия плана, дн.');
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
		Schema::drop('crypto_exchange_plans');
	}

}
