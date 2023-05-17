<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserCryptoExchangePlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_crypto_exchange_plans', function(Blueprint $table)
		{
			$table->foreign('crypto_exchange_plan_id')->references('id')->on('crypto_exchange_plans')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_crypto_exchange_plans', function(Blueprint $table)
		{
			$table->dropForeign('user_crypto_exchange_plans_crypto_exchange_plan_id_foreign');
			$table->dropForeign('user_crypto_exchange_plans_user_id_foreign');
		});
	}

}
