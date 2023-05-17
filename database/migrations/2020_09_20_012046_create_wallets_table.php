<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWalletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wallets', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('wallets_user_id_foreign')->comment('id пользователя');
			$table->bigInteger('currency_id')->unsigned()->index('wallets_currency_id_foreign')->comment('id криптовалюты');
			$table->string('address', 191)->comment('Адрес кошелька.');
			$table->string('additional_data', 191)->nullable()->comment('Дополнительные данные кошелька.');
			$table->bigInteger('wallet_type_id')->unsigned()->index('wallets_wallet_type_id_foreign')->comment('id типа кошелька');
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
		Schema::drop('wallets');
	}

}
