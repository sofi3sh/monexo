<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketingPlanPartnerProgramsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketing_plan_partner_programs', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('marketing_plan_id')->unsigned()->comment('id маркетингового плана');
			$table->smallInteger('partner_program_id')->comment('id партнерской программы (id: 1 - от прибыли партнеров; 2 - от инвестиции партнеров)');
			$table->smallInteger('line_number')->comment('Номер линии маркетингового плана');
			$table->float('profit', 5)->comment('% прибыли');
			$table->timestamps();
			$table->softDeletes();
			$table->unique(['marketing_plan_id','line_number'], 'marketing_plan_partner_programs_plan_id_line_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('marketing_plan_partner_programs');
	}

}
