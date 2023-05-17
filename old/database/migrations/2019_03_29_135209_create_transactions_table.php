<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')
                ->comment = "id пользователя-владельца транзакции.";
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('transaction_type_id')
                ->comment = "id типа транзакции.";
            $table->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types');

            $table->unsignedBigInteger('wallet_id')
                ->nullable()
                ->comment = "id кошелька, участвующего в транзакции.";
            $table->foreign('wallet_id')
                ->references('id')
                ->on('wallets');

            $table->decimal('amount_crypto', 15, 8)
                ->nullable()
                ->comment('Суммма операции в валюте currency_id.');
            $table->decimal('amount_usd', 11, 2)
                ->comment('Сумма операции в usd по курсу rate.');
            $table->decimal('rate', 15, 8)
                ->nullable()
                ->comment('Курс операции (валюты currency_id к rate).');

            MigrationHelper::addEditorIdField($table);
            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('transactions', 'Транзакции.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}