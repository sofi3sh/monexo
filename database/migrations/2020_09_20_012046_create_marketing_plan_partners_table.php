<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketingPlanPartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketing_plan_partners', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('marketing_plan_partners_user_id_foreign');
			$table->bigInteger('partner_id')->unsigned()->index('marketing_plan_partners_partner_id_foreign');
			$table->decimal('invested_usd', 15)->nullable();
			$table->decimal('invested_eth', 15, 8)->default(0.00000000);
			$table->decimal('invested_btc', 15, 8)->default(0.00000000);
			$table->decimal('invested_pzm', 15)->default(0.00);
			$table->decimal('profit', 15, 8)->nullable();
			$table->decimal('rate', 15, 8)->default(0.00000000)->comment('курс');
			$table->integer('line_number')->nullable();
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
		Schema::drop('marketing_plan_partners');
	}

}
