<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMarketingPlanPartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('marketing_plan_partners', function(Blueprint $table)
		{
			$table->foreign('partner_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('marketing_plan_partners', function(Blueprint $table)
		{
			$table->dropForeign('marketing_plan_partners_partner_id_foreign');
			$table->dropForeign('marketing_plan_partners_user_id_foreign');
		});
	}

}
