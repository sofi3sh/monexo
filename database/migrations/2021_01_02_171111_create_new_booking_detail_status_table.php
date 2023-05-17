<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewBookingDetailStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_detail_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descr_en', 64)->comment('Статус детализации заказа на английском');
            $table->string('descr_ru', 64)->comment('Статус детализации заказа на русском');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('descr_en', 'booking_detail_status_descr_en_unique');
            $table->unique('descr_ru', 'booking_detail_status_descr_ru_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_detail_status');
    }
}
