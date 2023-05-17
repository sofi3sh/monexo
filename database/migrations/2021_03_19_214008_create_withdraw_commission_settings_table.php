<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawCommissionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('withdraw_commission_settings')) {
            Schema::create('withdraw_commission_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('period')->comment('период в днях');
                $table->float('commission')->comment('комиссия за вывод денег');
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw_commission_settings');
    }
}
