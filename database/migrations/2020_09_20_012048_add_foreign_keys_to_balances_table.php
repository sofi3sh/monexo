<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBalancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('balances', function(Blueprint $table)
		{
			$table->foreign('balance_type_id')->references('id')->on('balance_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('balances', function(Blueprint $table)
		{
			$table->dropForeign('balances_balance_type_id_foreign');
		});
	}

}
