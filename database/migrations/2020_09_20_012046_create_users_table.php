<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191);
			$table->string('locale', 2)->default('en')->comment('Локализация пользователя.');
			$table->string('email', 191)->unique();
			$table->string('google_id')->nullable()->comment('Google ID');
			$table->string('phone', 191)->nullable()->comment('Телефон пользователя');
			$table->decimal('replenishment', 11)->default(0.00)->comment('все пополнения');
			$table->decimal('balance_usd', 11)->default(0.00)->comment('Текущий баланс.');
			$table->decimal('balance_eth', 15, 8)->default(0.00000000);
			$table->decimal('balance_btc', 15, 8)->default(0.00000000);
			$table->decimal('balance_pzm', 15)->default(0.00);
			$table->decimal('invested_usd', 11)->default(0.00)->comment('Общая инвестированная сумма.');
			$table->decimal('invested_eth', 15, 8)->default(0.00000000);
			$table->decimal('invested_btc', 15, 8)->default(0.00000000);
			$table->decimal('invested_pzm', 15)->default(0.00);
			$table->decimal('marketplace_purchased_shares', 12, 4)->default(0.0000)->comment('Куплено долей маркетплейса');
			$table->decimal('invested_usd_to_marketplace', 11)->default(0.00)->comment('Сколько всего пользователь инвестировал в маркетплейс.');
			$table->decimal('invested_eth_to_marketplace', 15, 8)->default(0.00000000);
			$table->decimal('invested_btc_to_marketplace', 15, 8)->default(0.00000000);
			$table->decimal('invested_pzm_to_marketplace', 15)->default(0.00);
			$table->decimal('profit_usd', 11)->default(0.00)->comment('Общая заработанная сумма.');
			$table->decimal('profit_eth', 15, 8)->default(0.00000000);
			$table->decimal('profit_btc', 15, 8)->nullable()->default(0.00000000);
			$table->decimal('profit_pzm', 15)->default(0.00);
			$table->decimal('referrals_usd', 11)->default(0.00)->comment('Сумма, заработанная на рефералах.');
			$table->decimal('referrals_eth', 15, 8)->default(0.00000000);
			$table->decimal('referrals_btc', 15, 8)->default(0.00000000);
			$table->decimal('referrals_pzm', 15)->default(0.00);
			$table->decimal('withdrawal_usd', 11)->default(0.00)->comment('Сумма, выведенная пользователем.');
			$table->decimal('withdrawal_eth', 15, 8)->default(0.00000000);
			$table->decimal('withdrawal_btc', 15, 8)->default(0.00000000);
			$table->decimal('withdrawal_pzm', 15)->default(0.00);
			$table->decimal('withdrawal_request_usd', 11)->default(0.00)->comment('Сумма заявок на вывод.');
			$table->float('bonuses_usd', 11)->default(0.00)->comment('Сумма начисленных бонусов');
			$table->integer('bonus_level')->default(0)->comment('Уровень бонусы');
			$table->decimal('bonuses_deposit', 15)->default(0.00)->comment('Бонусный депозит');
			$table->bigInteger('accrual_currency_id')->unsigned()->nullable()->comment('id криптовалюты в которой выполнять начисления');
			$table->integer('parent_id')->unsigned()->nullable()->comment('id пользователя, по реферальной ссылке которого пришел пользователь');
			$table->integer('right_id')->unsigned()->nullable()->default(0);
			$table->integer('left_id')->unsigned()->default(0);
			$table->string('ref_code', 191)->nullable()->comment('Реферальная ссылка пользователя');
			$table->text('exchange_name', 65535)->nullable()->comment('Название биржи.');
			$table->text('api_key', 65535)->nullable()->comment('API-ключи пользвателя для управления на бирже.');
			$table->text('visa', 65535)->nullable()->comment('Реквизиты Visa');
			$table->text('mastercard', 65535)->nullable()->comment('Реквизиты Mastercard');
			$table->text('qiwi', 65535)->nullable()->comment('Реквизиты Qiwi');
			$table->text('webmoney', 65535)->nullable()->comment('Реквизиты Webmoney');
			$table->text('yandexMoney', 65535)->nullable()->comment('Реквизиты Yandex Money');
			$table->boolean('is_trading_account')->default(0)->comment('Признак трейдинг-аккаунта (на котором доступна арбитражная торговля)');
			$table->bigInteger('motivation_plan_id')->unsigned()->nullable()->index('users_motivation_plan_id_foreign')->comment('id типа мотивационного плана');
			$table->dateTime('motivation_plan_start_at')->nullable()->comment('Дата начала действия мотивационного плана');
			$table->decimal('last_marketing_plan_profit', 10)->default(0.00)->comment('Сумма последнего начисления по маркетинг-плану (для оптимизации вычисления прибыли от линии)');
			$table->boolean('admin')->default(0)->comment('Признак админа.');
			$table->boolean('fake')->default(0)->comment('Признак фейковости пользователя');
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password', 191)->nullable();
			$table->string('email_reset_token', 191)->nullable()->unique()->comment('Токен сброса email');
			$table->string('new_email', 191)->nullable()->unique()->comment('Новый email');
			$table->string('remember_token', 100)->nullable();
			$table->bigInteger('editor_id')->unsigned()->nullable()->index('users_editor_id_foreign')->comment('id пользователя, выполнившего правки.');
			$table->timestamps();
			$table->softDeletes();
			$table->string('country', 191)->nullable()->comment('Страна пользователя');
			$table->integer('age')->nullable()->comment('Возраст');
			$table->string('add_contact', 191)->nullable()->comment('Дополнительный контакт');
			$table->index(['right_id','left_id','parent_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
