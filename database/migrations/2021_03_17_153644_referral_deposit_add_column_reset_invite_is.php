<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferralDepositAddColumnResetInviteIs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_deposit', function (Blueprint $table) {
            $table->boolean('reset_invite_is')
                ->after('is_accrued')
                ->nullable()
                ->default(0)
                ->comment('0 - ивайт не был отменен, 1 - его отменил крон');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('referral_deposit', 'reset_invite_is')) {
            Schema::table('referral_deposit', function (Blueprint $table) {
                $table->dropColumn('reset_invite_is');
            });
        }
    }
}
