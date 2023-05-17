<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketplaceInvestmentArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketplace_investment_articles', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('name_ru', 65535)->comment('Название статьи инвестирования.');
			$table->text('name_en', 65535);
			$table->text('name_de', 65535);
			$table->text('name_zh', 65535);
			$table->text('name_pl', 65535);
			$table->text('name_fr', 65535);
			$table->decimal('required_amount', 15)->comment('Необходимая сумма инвестирования');
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
		Schema::drop('marketplace_investment_articles');
	}

}
