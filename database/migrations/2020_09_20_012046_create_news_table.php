<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('header_ru', 191)->comment('Заголовок новости');
			$table->string('header_en', 191);
			$table->string('header_de', 191);
			$table->string('header_zh', 191);
			$table->string('header_pl', 191);
			$table->string('header_fr', 191);
			$table->text('short_description_ru', 65535)->nullable()->comment('Краткое описание новости');
			$table->text('short_description_en', 65535)->nullable();
			$table->text('short_description_de', 65535)->nullable();
			$table->text('short_description_zh', 65535)->nullable();
			$table->text('short_description_pl', 65535)->nullable();
			$table->text('short_description_fr', 65535)->nullable();
			$table->text('text_ru', 65535)->comment('Текст новости');
			$table->text('text_en', 65535);
			$table->text('text_de', 65535);
			$table->text('text_zh', 65535);
			$table->text('text_pl', 65535);
			$table->text('text_fr', 65535);
			$table->string('thumb')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news');
	}

}
