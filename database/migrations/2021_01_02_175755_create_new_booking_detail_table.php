<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewBookingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_detail', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('booking_id')->comment('id заказа');
            $table->foreign('booking_id')->references('id')->on('booking');

            $table->unsignedBigInteger('services_id')->comment('id услуги');
            $table->foreign('services_id')->references('id')->on('services');

            $table->unsignedBigInteger('status_id')->unsigned()->comment('id статуса заказа');
            $table->foreign('status_id')->references('id')->on('booking_detail_status');

            $table->decimal('amount_usd', 19, 2)->comment('Сумма заказа');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_detail');
    }
}
