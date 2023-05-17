<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bonuses', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('level')->comment('Уровни');
			$table->decimal('bonus', 15)->comment('Бонус');
			$table->decimal('personal_deposit', 15)->comment('Личный депозит');
			$table->decimal('team_turnover', 15)->comment('Оборот 1-й линии');
			$table->decimal('invitation_deposit', 15)->default(0.00)->comment('Пригласительный депозит');
			$table->decimal('matching_bonus', 3)->default(0.00)->comment('Матчинг бонус');
			$table->integer('affiliate_magnet')->default(0)->comment('Партнёрский магнит');
			$table->boolean('fast_start')->default(0)->comment('Быстрый старт');
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
		Schema::drop('bonuses');
	}

}
