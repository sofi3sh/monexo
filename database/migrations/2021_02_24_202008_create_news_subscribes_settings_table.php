<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsSubscribesSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_subscribes_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('week_day')->comment('День недели. 0 - вс');
            $table->integer('month_day')->comment('День месяца');
            $table->time('dispatch_time')->comment('Время отправления');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_subscribes_settings');
    }
}
