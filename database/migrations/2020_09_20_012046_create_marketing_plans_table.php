<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketingPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketing_plans', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191)->comment('Название плана');
			$table->enum('currency_type', array('usd','btc','eth','pzm'))->default('usd');
			$table->float('min_invest_sum')->comment('Минимальная сумма инвестирования в пакет');
			$table->float('max_invest_sum')->comment('Максимальная сумма инвестирования в пакет');
			$table->integer('min_duration')->comment('Минимальная длительность работы депозита');
			$table->integer('max_duration')->comment('Максимальная длительность работы депозита');
			$table->integer('first_days_count_for_simple_percent')->comment('Кол-во первых дней, когда начисляются простые проценты.');
			$table->float('daily_percent')->nullable();
			$table->boolean('only_business_days')->comment('Признак, что начислять только в рабочие дни');
			$table->float('min_profit', 5)->comment('Минимальная прибыль');
			$table->float('max_profit', 5)->comment('Максимальная прибыль в день');
			$table->float('manual_percent', 4)->nullable()->comment('Процент следующих начислений, указанный вручную.');
			$table->float('min_withdrawal_request', 5)->comment('Ограничение на создание заявки на вывод при активном плане');
			$table->float('coin_percent', 5)->comment('% прибыли, который переводится на счет коина');
			$table->boolean('available_for_withdrawal')->default(0)->comment('Доступно к выводу');
			$table->decimal('withdrawal_commission', 3)->nullable()->comment('Комиссия на вывод');
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
		Schema::drop('marketing_plans');
	}

}
