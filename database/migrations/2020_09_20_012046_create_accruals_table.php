<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccrualsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accruals', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->float('percent', 5)->comment('Начисленный процент');
			$table->float('percent_month')->nullable()->comment('Месячный процент');
			$table->text('meta', 65535)->nullable()->comment('Дополнительные данные начисления.');
			$table->timestamp('start')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Начали начисления');
			$table->dateTime('end')->default('0000-00-00 00:00:00')->comment('Закончили начисления');
			$table->text('comment', 65535)->nullable()->comment('Комментарий к начислению.');
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
		Schema::drop('accruals');
	}

}
