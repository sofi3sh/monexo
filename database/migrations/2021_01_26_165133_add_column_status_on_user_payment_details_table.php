<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusOnUserPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_payment_details', function (Blueprint $table) {
            $table->unsignedBigInteger('status')
                ->after('transaction_id')
                ->nullable()
                ->comment('Статус платежа. 1 - нажимали кнопку "Яоплатил" / "Подтвердить"');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_payment_details', 'status')) {
            Schema::table('user_payment_details', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
}
