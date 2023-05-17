<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCommissionPercentOnTableReferralDeposit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_deposit', function (Blueprint $table) {
            $table->decimal('commission_percent', 18,2)
                ->after('amount_usd')
                ->nullable()
                ->comment('Комиссия взятая с суммы снятия в процентах');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('referral_deposit', 'commission_percent')) {
            Schema::table('referral_deposit', function (Blueprint $table) {
                $table->dropColumn('commission_percent');
            });
        }
    }
}
