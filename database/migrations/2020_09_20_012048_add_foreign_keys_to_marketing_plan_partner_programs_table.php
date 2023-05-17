<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMarketingPlanPartnerProgramsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('marketing_plan_partner_programs', function(Blueprint $table)
		{
			$table->foreign('marketing_plan_id')->references('id')->on('marketing_plans')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('marketing_plan_partner_programs', function(Blueprint $table)
		{
			$table->dropForeign('marketing_plan_partner_programs_marketing_plan_id_foreign');
		});
	}

}
