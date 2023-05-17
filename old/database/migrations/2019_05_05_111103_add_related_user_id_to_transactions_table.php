<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddRelatedUserIdToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('related_user_id')
                ->nullable(true)
                ->after('end_period')
                ->comment('id, связанного с транзакций пользователя.');
            $table->foreign('related_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'related_user_id')) {
                Schema::table('string', function (Blueprint $table) {
                    $table->dropColumn('related_user_id');
                });
            }
        });
    }
}
