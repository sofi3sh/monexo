<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvestedProfitReferralsWithdrawalFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('amount_usd');

            $table->decimal('withdrawal_request_usd', 11, 2)
                ->after('email')
                ->default(0)
                ->nullable(false)
                ->comment('Сумма заявок на вывод.');

            $table->decimal('withdrawal_usd', 11, 2)
                ->after('email')
                ->default(0)
                ->nullable(false)
                ->comment('Сумма, заработанная на рефералах.');

            $table->decimal('referrals_usd', 11, 2)
                ->after('email')
                ->default(0)
                ->nullable(false)
                ->comment('Сумма, заработанная на рефералах.');

            $table->decimal('profit_usd', 11, 2)
                ->after('email')
                ->default(0)
                ->nullable(false)
                ->comment('Общая заработанная сумма.');

            $table->decimal('invested_usd', 11, 2)
                ->after('email')
                ->default(0)
                ->nullable(false)
                ->comment('Общая инвестированная сумма.');

            $table->decimal('balance_usd', 11, 2)
                ->after('email')
                ->default(0)
                ->nullable(false)
                ->comment('Текущий баланс.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'withdrawal_request_usd')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('withdrawal_request_usd');
                });
            }

            if (Schema::hasColumn('users', 'withdrawal_usd')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('withdrawal_usd');
                });
            }

            if (Schema::hasColumn('users', 'referrals_usd')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('referrals_usd');
                });
            }

            if (Schema::hasColumn('users', 'profit_usd')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('profit_usd');
                });
            }

            if (Schema::hasColumn('users', 'invested_usd')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('invested_usd');
                });
            }

            if (Schema::hasColumn('users', 'balance_usd')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('balance_usd');
                });
            }
        });
    }
}
