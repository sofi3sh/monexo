<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketingPlanGlobalStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketing_plan_global_statistics', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ru', 191)->comment('Название параметра');
			$table->string('name_en', 191)->nullable();
			$table->string('value', 191)->comment('Значение');
			$table->string('comment', 191)->comment('Комментарий к параметру');
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
		Schema::drop('marketing_plan_global_statistics');
	}

}
