<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequisitesFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('yandexMoney')->after('api_key')->nullable(true)->comment('Реквизиты Yandex Money');
            $table->text('webmoney')->after('api_key')->nullable(true)->comment('Реквизиты Webmoney');
            $table->text('qiwi')->after('api_key')->nullable(true)->comment('Реквизиты Qiwi');
            $table->text('mastercard')->after('api_key')->nullable(true)->comment('Реквизиты Mastercard');
            $table->text('visa')->after('api_key')->nullable(true)->comment('Реквизиты Visa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
