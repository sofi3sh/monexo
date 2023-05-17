<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserMarketingPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_marketing_plans', function(Blueprint $table)
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
		Schema::table('user_marketing_plans', function(Blueprint $table)
		{
			$table->dropForeign('user_marketing_plans_marketing_plan_id_foreign');
		});
	}

}
