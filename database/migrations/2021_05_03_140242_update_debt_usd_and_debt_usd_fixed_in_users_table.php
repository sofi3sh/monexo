<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDebtUsdAndDebtUsdFixedInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                DB::beginTransaction();
                try {
                    DB::update("UPDATE users join (SELECT u.id as 'user_id', sum(ump.invested_usd / 100 * 
                    (
                    CASE
                      WHEN (mp.daily_percent = 0 ) THEN ((mp.min_profit + mp.max_profit) / 2)
                      ELSE mp.daily_percent
                    END
                    )
                    * floor(ump.days_left / mp.accrual_period) + 
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
                  AND ump.end_at is null
                  GROUP BY u.id) as debts_table ON (debts_table.user_id = users.id) SET users.debt_usd = debts_table.debt_usd;");

                  DB::table('users')->update([
                      'debt_usd' => DB::raw('debt_usd + balance_usd')
                  ]);

                  DB::table('users')->update(['debt_usd_fixed' => DB::raw('debt_usd')]);
                
                  DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error($e->getMessage());
                }
            });
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
            //
        });
    }
}
