<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class AddIpnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wallet_id')
                ->nullable()
                ->comment = "id кошелька, участвующего в транзакции.";
            $table->foreign('wallet_id')
                ->references('id')
                ->on('wallets');
            // Адрес кошелька нужен, поскольку wallet_id может быть null
            // (по какой-то причине пришли средства на кошелек, которого нет в wallets?)
            $table->string('address')->comment('Кошелек, на который были переведены средства.');
            $table->string('dest_tag')->comment('Дополнительные реквизиты кошелька.');
            $table->decimal('amount', 25, 18)->comment('Сумма в криптовалюте.');
            //$table->bigInteger('amounti')->comment('Сумма в криптовалюте в целочисленном формате.');
            $table->integer('confirms')->comment('Количество подтверждений.');
            $table->string('currency')->comment('Обозначение криптовалюты.');
            $table->decimal('fiat_amount', 20, 8)->comment('Сумма в фиатных деньгах по курсу.');
            //$table->bigInteger('fiat_amounti')->comment('Сумма в фиатных деньгах по курсу в целочисленном формате.');
            $table->string('fiat_coin')->comment('Обозначение фиатных денег.');
            $table->string('ipn_id')->comment('id IPN');
            //$table->string('ipn_mode')->comment('IPN mode');
            //$table->string('ipn_type')->comment('IPN type');
            //$table->string('ipn_version')->comment('IPN version');
            $table->string('merchant')->comment('id merchant');
            $table->integer('status')->comment('Статус транзакции.');
            $table->string('status_text')->comment('Текст статуса транзакции.');
            $table->string('txn_id')->comment('Хэш транзакции.');
            $table->text('request_data')->comment('Весь post-запрос.');
            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('ipns', 'Данные IPN post-запросов с coinpayments.net с входящими платежами.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ipns');
    }
}
