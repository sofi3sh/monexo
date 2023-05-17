<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBalancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('balances', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->comment('id пользователя');
			$table->bigInteger('balance_type_id')->unsigned()->index('balances_balance_type_id_foreign')->comment('id типа баланса');
			$table->float('balance', 15)->comment('Сумма баланса');
			$table->bigInteger('currency_id')->unsigned()->comment('id валюты баланса');
			$table->timestamps();
			$table->unique(['user_id','balance_type_id','currency_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('balances');
	}

}
