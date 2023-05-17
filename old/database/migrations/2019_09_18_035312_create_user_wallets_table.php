<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateUserWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('id пользователя');
            $table->unsignedBigInteger('currency_id')->comment('id криптовалюты');
            $table->decimal('amount', 15, 8)
                ->default(0)
                ->comment('Баланс криптовалюты.');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies');

            $table->index(['user_id', 'currency_id']);
        });

        MigrationHelper::addCommentToTable('wallets', 'Кошельки пользователей.');
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
