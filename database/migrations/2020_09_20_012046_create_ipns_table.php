<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ipns', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('wallet_id')->index('wallet_id')->comment('id кошелька, участвующего в транзакции.');
			$table->string('address', 191)->comment('Кошелек, на который были переведены средства.');
			$table->string('dest_tag', 191)->nullable();
			$table->decimal('amount', 25, 18)->comment('Сумма в криптовалюте.');
			$table->integer('confirms')->comment('Количество подтверждений.');
			$table->string('currency', 191)->comment('Обозначение криптовалюты.');
			$table->decimal('fiat_amount', 20, 8)->comment('Сумма в фиатных деньгах по курсу.');
			$table->string('fiat_coin', 191)->comment('Обозначение фиатных денег.');
			$table->string('ipn_id', 191)->comment('id IPN');
			$table->string('merchant', 191)->comment('id merchant');
			$table->integer('status')->comment('Статус транзакции.');
			$table->string('status_text', 191)->comment('Текст статуса транзакции.');
			$table->string('txn_id', 191)->comment('Хэш транзакции.');
			$table->string('request_data', 191)->comment('Весь post-запрос.');
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
		Schema::drop('ipns');
	}

}
