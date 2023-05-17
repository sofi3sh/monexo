<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->comment = "id пользователя";
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('currency_id')->comment = "id криптовалюты";
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->string('address')->comment = "Адрес кошелька.";
            $table->string('additional_data')->nullable()->comment = "Дополнительные данные кошелька.";

            $table->unsignedBigInteger('wallet_type_id')->comment = "id типа кошелька";
            $table->foreign('wallet_type_id')->references('id')->on('wallet_types');

            $table->timestamps();
            $table->softDeletes();

            // Адрес + доп. атрибуты кошелька + тип кошелька (для ввода или вывода)- уникальны
            $table->unique(['address', 'additional_data', 'wallet_type_id']);
        });

        MigrationHelper::addCommentToTable('wallets', 'Адреса криптокошельков пользователей.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
