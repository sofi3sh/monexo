<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyPartnersMapAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_partners_map_apps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('telegram');
            $table->string('city')->comment('Город введенные пользователем');
            $table->tinyInteger('status')->comment('0 - не обработана, 1 - обработана'); 
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
        Schema::dropIfExists('buy_partners_map_apps');
    }
}
