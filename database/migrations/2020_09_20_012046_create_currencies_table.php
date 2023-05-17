<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('currencies', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191)->unique()->comment('Название валюты.');
			$table->string('code', 191)->comment('Обозначение валюты.');
			$table->smallInteger('rate_decimal_digits')->comment('Кол-во десятичных разрядов в курсе валюты.');
			$table->boolean('invest_allowed')->default(1)->comment('Разрешено использовать для ввода.');
			$table->boolean('withdrawal_allowed')->default(1)->comment('Разрешено использовать для вывода.');
			$table->boolean('show_rate_on_landing')->default(0)->comment('Признак, надо или нет показывать этот курс на лендинге.');
			$table->boolean('is_crypto')->default(1)->comment('Признак, что это криптовалюта. Пошли костыли, чтобы подключить плат. системы.');
			$table->boolean('in_arbitrage_trading')->default(0)->comment('Признак, что криптовалюта доступна в арбитражной торговле.');
			$table->string('blockchain_addr', 191)->nullable()->comment('Адрес блокчена для проверки транзакции.');
			$table->decimal('withdrawal_commission', 3)->default(1.00);
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
		Schema::drop('currencies');
	}

}
