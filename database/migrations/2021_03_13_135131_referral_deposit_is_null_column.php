<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferralDepositIsNullColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_deposit', function (Blueprint $table) {
            $table->decimal('amount_usd', 18, 2)
                ->nullable()
                ->comment('Сумма снятая с баланса')
                ->change();

            $table->string('currency', 127)
                ->nullable()
                ->comment('Валюта')
                ->change();

            $table->bigInteger('marketing_plan_id')
                ->nullable()
                ->comment('Ссылка на пакет')
                ->change();

            $table->string('marketing_plan_descr', 255)
                ->nullable()
                ->comment('Текстовое наименование пакета и сумма строкой')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if ( Schema::hasColumn('referral_deposit', 'amount_usd') ) {
            $countAmountUSD = DB::table('referral_deposit')
                ->select( DB::raw('COUNT(amount_usd) as count_amount_usd') )
                ->pluck('count_amount_usd')
                ->first();
            if ( $countAmountUSD === 0 ) {
                Schema::table('referral_deposit', function (Blueprint $table) {
                    $table->decimal('amount_usd', 18, 2)
                        ->comment('Сумма снятая с баланса')
                        ->change();;
                });
            }
        }

        if ( Schema::hasColumn('referral_deposit', 'currency') ) {
            $countCurrency = DB::table('referral_deposit')
                ->select( DB::raw('COUNT(currency) as count_currency') )
                ->pluck('count_currency')
                ->first();
            if ( $countCurrency === 0 ) {
                Schema::table('referral_deposit', function (Blueprint $table) {
                    $table->string('currency', 127)
                        ->comment('Валюта')
                        ->change();;
                });
            }
        }

        if ( Schema::hasColumn('referral_deposit', 'marketing_plan_id') ) {
            $countMarketingPlanId = DB::table('referral_deposit')
                ->select( DB::raw('COUNT(marketing_plan_id) as count_marketing_plan_id') )
                ->pluck('marketing_plan_id')
                ->first();
            if ( $countMarketingPlanId === 0 ) {
                Schema::table('referral_deposit', function (Blueprint $table) {
                    $table->bigInteger('marketing_plan_id')
                        ->comment('Ссылка на пакет')
                        ->change();;
                });
            }
        }

        if ( Schema::hasColumn('referral_deposit', 'marketing_plan_descr') ) {
            $countMarketingPlanDescr = DB::table('referral_deposit')
                ->select( DB::raw('COUNT(marketing_plan_descr) as count_marketing_plan_descr') )
                ->pluck('marketing_plan_descr')
                ->first();
            if ( $countMarketingPlanDescr === 0 ) {
                Schema::table('referral_deposit', function (Blueprint $table) {
                    $table->string('marketing_plan_descr', 255)
                        ->comment('Текстовое наименование пакета и сумма строкой')
                        ->change();;
                });
            }
        }
    }
}
