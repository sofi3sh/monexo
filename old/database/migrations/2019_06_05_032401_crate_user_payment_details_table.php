<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CrateUserPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')
                ->comment = "id пользователя";
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('currency_id')
                ->comment = "id криптовалюты (по факту - платежной системы)";
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies');

            $table->string('address')
                ->comment = "Адрес кошелька (по факту - реквизиты плат. сист.)";

            $table->string('additional_data')
                ->nullable(true)
                ->comment = "Дополнительные данные плат. сист.";

            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('user_payment_details', 'Реквизиты платежных систем пользователя.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payment_details');
    }
}
