<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiKeyFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('api_key')
                ->nullable(true)
                ->after('ref_code')
                ->comment('API-ключи пользвателя для управления на бирже.');

            $table->text('exchange_name')
                ->nullable(true)
                ->after('ref_code')
                ->comment('Название биржи.');
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
            if (Schema::hasColumn('users', 'api_key')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('api_key');
                });
            };

            if (Schema::hasColumn('users', 'exchange_name')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('exchange_name');
                });
            }
        });
    }
}
