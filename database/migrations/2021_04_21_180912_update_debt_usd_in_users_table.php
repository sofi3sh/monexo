<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDebtUsdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::update("UPDATE users join (SELECT u.id as 'user_id', sum(ump.invested_usd / 100 * 
              (
              CASE
                WHEN (mp.daily_percent = 0 ) THEN ((mp.min_profit + mp.max_profit) / 2)
                ELSE mp.daily_percent
              END
              )
              * (ump.days_left / mp.accrual_period) + 
              (
                CASE
                    WHEN (ump.stop_at IS NOT NULL and ump.days_left > 0) THEN ump.invested_usd
                    WHEN (mp.body_on = 1) THEN 0
                    ELSE ump.invested_usd
                END
              )
            ) as 'debt_usd'
            FROM user_marketing_plans as ump
            JOIN users as u on (u.id = ump.user_id)
            JOIN marketing_plans as mp on (mp.id = ump.marketing_plan_id)
            WHERE ump.days_left > 0
            AND u.is_active = 1
            AND u.fake = 0
            AND u.deleted_at is null
            AND ump.end_at is null
            GROUP BY u.id) as debts_table ON (debts_table.user_id = users.id) SET users.debt_usd = debts_table.debt_usd;");
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
            DB::update("UPDATE users join
                        (
                        	SELECT u.id as 'user_id', sum(ump.invested_usd / 100 *
							(
                        	CASE
                            	WHEN (mp.min_profit = 0 OR mp.max_profit = 0) THEN daily_percent
                            	ELSE ((mp.min_profit + mp.max_profit) / 2)
                        	END
                        	)
                        	* (ump.days_left / mp.accrual_period) +
                        	(
                        	CASE
                            	WHEN (mp.body_on = 1) THEN 0
                            	ELSE ump.invested_usd
                        	END
                        	)
                        ) + u.balance_usd as 'debt_usd'
                        from user_marketing_plans as ump
                        join users as u on (u.id = ump.user_id)
                        join marketing_plans as mp on (mp.id = ump.marketing_plan_id)
                        WHERE days_left > 0
                        and u.is_active = 1
                        and u.fake = 0
                        and u.deleted_at is null
                        and ump.stop_at is null
                        and ump.end_at is null
                        group by u.id) as debts_table ON (debts_table.user_id = users.id) SET users.debt_usd = 0;");
        });
    }
}
