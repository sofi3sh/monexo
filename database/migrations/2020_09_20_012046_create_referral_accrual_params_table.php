<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReferralAccrualParamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('referral_accrual_params', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('level')->comment('Уровень реферала.');
			$table->bigInteger('transaction_type_id')->unsigned()->index('referral_accrual_params_transaction_type_id_foreign')->comment('id типа транзакции');
			$table->integer('percent')->comment('Процент от дохода реферала конкретного уровня, который получает рефер.');
			$table->boolean('accrue')->default(1)->comment('Надо ли начислять прибыль по данному уровню.');
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
		Schema::drop('referral_accrual_params');
	}

}
