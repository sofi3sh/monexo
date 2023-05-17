<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBauntyLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('baunty_links', function(Blueprint $table)
		{
			$table->foreign('package_id')->references('id')->on('baunty_packages')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('baunty_links', function(Blueprint $table)
		{
			$table->dropForeign('baunty_links_package_id_foreign');
			$table->dropForeign('baunty_links_user_id_foreign');
		});
	}

}
