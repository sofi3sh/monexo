<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReferralAccrualParamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('referral_accrual_params', function(Blueprint $table)
		{
			$table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('referral_accrual_params', function(Blueprint $table)
		{
			$table->dropForeign('referral_accrual_params_transaction_type_id_foreign');
		});
	}

}
