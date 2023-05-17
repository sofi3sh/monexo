<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserWalletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_wallets', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->comment('id пользователя');
			$table->bigInteger('currency_id')->unsigned()->index('user_wallets_currency_id_foreign')->comment('id криптовалюты');
			$table->decimal('amount', 15, 8)->default(0.00000000)->comment('Баланс криптовалюты.');
			$table->timestamps();
			$table->softDeletes();
			$table->index(['user_id','currency_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_wallets');
	}

}
