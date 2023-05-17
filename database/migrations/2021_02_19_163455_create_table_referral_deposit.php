<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReferralDeposit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_deposit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index('booking_user_id_foreign')->comment('id пользователя');
            $table->decimal('amount_usd', 18, 2)->default(0.00)->comment('Сумма снятая с баланса');
            $table->string('currency', 127)->comment('Валюта');
            $table->boolean('is_accrued')->default(0)->comment('0 - не зачисленно реферралу, 1 - зачисленно');
            $table->string('referral_email', 255)->comment('email реферрала');
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
        Schema::dropIfExists('referral_deposit');
    }
}
