<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBalanceTypeTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('balance_type_translations', function(Blueprint $table)
		{
			$table->foreign('balance_type_id')->references('id')->on('balance_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('balance_type_translations', function(Blueprint $table)
		{
			$table->dropForeign('balance_type_translations_balance_type_id_foreign');
		});
	}

}
