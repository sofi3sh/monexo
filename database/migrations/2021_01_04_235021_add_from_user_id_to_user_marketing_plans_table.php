<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFromUserIdToUserMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('from_user_id')
                ->nullable()
                ->after('user_id')
                ->comment('ID пользователя, от кого открылся пакет');

            $table->foreign('from_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_marketing_plans', function (Blueprint $table) {
            $table->dropForeign(['from_user_id']);
            $table->dropColumn('from_user_id');
        });
    }
}
