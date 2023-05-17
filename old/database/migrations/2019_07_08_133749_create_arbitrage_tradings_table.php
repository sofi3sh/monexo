<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateArbitrageTradingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbitrage_tradings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('id пользователя');
            $table->dateTime('start')->comment('Начало арбитражной торговли');
            $table->dateTime('end')->nullable(true)->comment('Окончание арбитражной торговли');
            $table->decimal('amount_usd', 15, 2)->comment('Сумма, поставленная на арбитражную торговлю');
            $table->unsignedBigInteger('currency_id')->comment('id криптовалюты, выбранной для арбитражной торговли');
            $table->unsignedBigInteger('buy_cryptocurrency_exchange_id')->nullable(true)->comment('id криптовалютной биржи на которой была куплена криптовалюта');
            $table->decimal('buy_rate', 15, 6)->comment('Курс, по которому была приобретена криптовалюта');
            $table->unsignedBigInteger('sell_cryptocurrency_exchange_id')->nullable(true)->comment('id криптовалютной биржи на которой была продана криптовалюта');
            $table->decimal('sell_rate', 15, 6)->nullable(true)->comment('Курс, по которому была продана криптовалюта');
            $table->decimal('profit_usd', 15, 4)->nullable(true)->comment('Полученная от операции прибыль');
            $table->decimal('user_profit_usd', 15, 4)->nullable(true)->comment('Прибыль пользователя от операции');
            $table->text('data')->nullable(true)->comment('Дополнительные данные о выполненной арбитражной торговле');
            $table->boolean('is_result_shown')->default(false)->comment('флаг, что результат был показан пользователю');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('buy_cryptocurrency_exchange_id')->references('id')->on('cryptocurrency_exchanges');
            $table->foreign('sell_cryptocurrency_exchange_id')->references('id')->on('cryptocurrency_exchanges');
        });

        MigrationHelper::addCommentToTable('arbitrage_tradings', 'Арбитражные торги пользователей.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arbitrage_tradings');
    }
}
