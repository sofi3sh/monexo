<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserPaymentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_payment_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('user_payment_details_user_id_foreign')->comment('id пользователя');
			$table->bigInteger('currency_id')->unsigned()->index('user_payment_details_currency_id_foreign')->comment('id криптовалюты (по факту - платежной системы)');
			$table->string('address', 191)->comment('Адрес кошелька (по факту - реквизиты плат. сист.)');
			$table->string('additional_data', 191)->nullable()->comment('Дополнительные данные плат. сист.');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('transaction_id')->nullable()->comment('id транзакции');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_payment_details');
	}

}
