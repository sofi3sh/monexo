<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('transactions_user_id_foreign')->comment('id пользователя-владельца транзакции.');
			$table->bigInteger('transaction_type_id')->unsigned()->index('transactions_transaction_type_id_foreign')->comment('id типа транзакции.');
			$table->bigInteger('wallet_id')->unsigned()->nullable()->index('transactions_wallet_id_foreign')->comment('id кошелька, участвующего в транзакции.');
			$table->decimal('amount_crypto', 15, 8)->nullable()->comment('Суммма операции в валюте currency_id.');
			$table->decimal('amount_usd', 11)->default(0.00)->comment('Сумма операции в usd по курсу rate.');
			$table->decimal('amount_eth', 15, 8)->default(0.00000000);
			$table->decimal('amount_btc', 15, 8)->default(0.00000000);
			$table->decimal('amount_pzm', 15)->default(0.00);
			$table->decimal('rate', 15, 8)->nullable()->comment('Курс операции (валюты currency_id к rate).');
			$table->decimal('commission', 4)->default(0.00)->comment('Комиссия операции (сумма операции указана без комиссии).');
			$table->float('balance_usd_after_transaction', 11)->default(0.00)->comment('Баланс пользователя после выполнения данной транзакции.');
			$table->decimal('balance_eth_after_transaction', 15, 8)->default(0.00000000);
			$table->decimal('balance_btc_after_transaction', 15, 8)->default(0.00000000);
			$table->decimal('balance_pzm_after_transaction', 15)->default(0.00);
			$table->float('percent', 5)->nullable()->comment('Процент транзакции (начисления, комиссии и т.п.)');
			$table->float('percent_on_amount', 11)->nullable()->comment('От какой суммы брался процент.');
			$table->integer('line_number')->nullable()->comment('В транзакциях прибылях от партнеров - хранение линии с которой был доход');
			$table->timestamp('end_period')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Дата до которой нельзя выводить средства (т.е. до которой средства не доступны).');
			$table->bigInteger('related_user_id')->unsigned()->nullable()->index('transactions_related_user_id_foreign')->comment('id, связанного с транзакций пользователя.');
			$table->bigInteger('related_user_wallet_id')->unsigned()->nullable()->index('transactions_related_user_wallet_id_foreign')->comment('Связанный виртуальный криптокошелек.');
			$table->bigInteger('editor_id')->unsigned()->nullable()->index('transactions_editor_id_foreign')->comment('id пользователя, выполнившего правки.');
			$table->integer('currency_id')->nullable();
			$table->text('comment', 65535)->nullable();
			$table->boolean('manual')->default(0)->comment('Транзакция создана вручную.');
			$table->string('name', 11)->nullable();
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
		Schema::drop('transactions');
	}

}
