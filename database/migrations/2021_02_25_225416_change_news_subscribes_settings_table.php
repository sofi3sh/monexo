<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNewsSubscribesSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_subscribes_settings', function (Blueprint $table) {
            $table->renameColumn('dispatch_time', 'month_dispatch_time');
            $table->time('week_dispatch_time')->comment('Время отправки для недельной подписки');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_subscribes_settings', function (Blueprint $table) {
            $table->renameColumn('month_dispatch_time', 'dispatch_time');
            $table->removeColumn('week_dispatch_time');
        });
    }
}
