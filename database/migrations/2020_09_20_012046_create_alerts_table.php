<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alerts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('alerts_user_id_foreign');
			$table->bigInteger('alert_id')->unsigned()->index('alerts_alert_id_foreign');
			$table->string('email', 191)->nullable();
			$table->decimal('amount', 15, 8)->nullable();
			$table->integer('currency_id')->nullable();
			$table->integer('status')->default(0);
			$table->enum('currency_type', array('usd','btc','eth','pzm'))->default('usd');
			$table->integer('marketing_plan_id')->nullable();
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
		Schema::drop('alerts');
	}

}
