<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCryptoExchangePlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_crypto_exchange_plans', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('user_crypto_exchange_plans_user_id_foreign')->comment('id пользователя');
			$table->bigInteger('crypto_exchange_plan_id')->unsigned()->index('user_crypto_exchange_plans_crypto_exchange_plan_id_foreign')->comment('id плана обмена');
			$table->dateTime('start_at')->comment('Начало действия плана');
			$table->dateTime('end_at')->comment('Окончание действия плана');
			$table->dateTime('period_start_at')->nullable()->comment('Начало периода (когда был выполнен первый обмен периода)');
			$table->integer('executed_number_exchanges_for_period')->comment('Выполненное количество обменов за период');
			$table->boolean('is_active')->default(1)->comment('Признак, что план является активным');
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
		Schema::drop('user_crypto_exchange_plans');
	}

}
