<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMessagesInTableAlertTypesWhereId32 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alert_types', function (Blueprint $table) {
            DB::update('UPDATE alert_types SET message_ru = "Отправка денежного перевода",
            message_en = "Sending money transfer" WHERE id=32');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alert_types', function (Blueprint $table) {
            DB::update('UPDATE alert_types SET message_ru = "Денежный перевод",
                message_en = "Money Transfer" WHERE id=32');
        });
    }
}
