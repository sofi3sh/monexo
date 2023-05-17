<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transactions', function(Blueprint $table)
		{
			$table->foreign('editor_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('related_user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('related_user_wallet_id')->references('id')->on('user_wallets')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wallet_id')->references('id')->on('wallets')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transactions', function(Blueprint $table)
		{
			$table->dropForeign('transactions_editor_id_foreign');
			$table->dropForeign('transactions_related_user_id_foreign');
			$table->dropForeign('transactions_related_user_wallet_id_foreign');
			$table->dropForeign('transactions_transaction_type_id_foreign');
			$table->dropForeign('transactions_wallet_id_foreign');
		});
	}

}
