<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMotivationPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('motivation_plans', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191)->comment('Название плана');
			$table->float('price')->comment('Цена плана');
			$table->float('min_invest_sum')->comment('Минимально инвестированная сумма для покупки плана');
			$table->float('min_balance')->comment('Минимальный баланс для покупки плана');
			$table->float('min_withdrawal')->comment('Минимальный вывод');
			$table->float('withdrawal_commission_percent')->comment('Комиссия вывода, %');
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
		Schema::drop('motivation_plans');
	}

}
