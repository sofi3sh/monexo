<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBauntyLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('baunty_links', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('baunty_links_user_id_foreign');
			$table->bigInteger('package_id')->unsigned()->index('baunty_links_package_id_foreign');
			$table->string('link', 191);
			$table->enum('status', array('accepted','canceled','notexecuted'))->default('notexecuted');
			$table->softDeletes();
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
		Schema::drop('baunty_links');
	}

}
