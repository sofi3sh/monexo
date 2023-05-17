<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneVerificationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_verification_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10);
            $table->unsignedBigInteger('user_id')->index();
            $table->string('phone', 64);
            $table->dateTime('expiration');
            $table->boolean('is_used')->default(false)->index();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_verification_codes');
    }
}
