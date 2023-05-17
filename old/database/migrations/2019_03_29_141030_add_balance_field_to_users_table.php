<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBalanceFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('amount_usd', 11, 2)
                ->after('email')
                ->default(0)
                ->nullable(false)
                ->comment('Актуальный баланс пользователя.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'amount_usd')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('amount_usd');
            });
        }
    }
}
