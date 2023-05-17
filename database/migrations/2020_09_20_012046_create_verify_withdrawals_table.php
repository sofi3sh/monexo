<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVerifyWithdrawalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('verify_withdrawals', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('verify_withdrawals_user_id_foreign');
			$table->bigInteger('currency_id')->unsigned()->index('verify_withdrawals_currency_id_foreign');
			$table->string('token', 191);
			$table->decimal('amount', 15, 8)->nullable();
			$table->string('address', 191);
			$table->string('name', 191)->nullable();
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
		Schema::drop('verify_withdrawals');
	}

}
