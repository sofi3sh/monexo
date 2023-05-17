<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewedColumnInTicketAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_answer', function (Blueprint $table) {
            $table->boolean('viewed')->after('user_id')->default('1')->comment('Индикатор прочитанности сообщения');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_answer', function (Blueprint $table) {
            $table->dropColumn('viewed');
        });
    }
}
