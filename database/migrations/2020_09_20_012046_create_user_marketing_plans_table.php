<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserMarketingPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_marketing_plans', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('user_marketing_plans_user_id_foreign')->comment('id маркетингового плана');
			$table->bigInteger('marketing_plan_id')->unsigned()->index('user_marketing_plans_marketing_plan_id_foreign')->comment('id маркетингового плана');
			$table->float('invested_usd', 9)->comment('Инвестированная в план сумма');
			$table->decimal('invested_eth', 15, 8)->default(0.00000000);
			$table->decimal('invested_btc', 15, 8)->default(0.00000000);
			$table->decimal('invested_pzm', 15)->default(0.00);
			$table->float('balance_usd')->comment('Текущий баланс на маркетинговом плане');
			$table->decimal('balance_eth', 15, 8)->default(0.00000000);
			$table->decimal('balance_btc', 15, 8)->default(0.00000000);
			$table->decimal('balance_pzm', 15)->default(0.00);
			$table->float('profit_usd', 9)->default(0.00)->comment('Полученная прибыль');
			$table->decimal('profit_eth', 15, 8)->default(0.00000000);
			$table->decimal('profit_btc', 15, 8)->default(0.00000000);
			$table->decimal('profit_pzm', 15)->default(0.00);
			$table->decimal('rate', 15, 8)->default(0.00000000)->comment('курс');
			$table->float('partner_profit_usd', 9)->default(0.00)->comment('Полученная прибыль по партнерской программе (по доходу партнера)');
			$table->float('coin_usd', 9)->default(0.00)->comment('Сумма на балансе коина');
			$table->dateTime('start_at')->comment('Дата начала действия плана');
			$table->dateTime('end_at')->nullable()->comment('Дата окончания действия плана');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('days_left')->default(0)->comment('Остаток дней работі инвест плана');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_marketing_plans');
	}

}
