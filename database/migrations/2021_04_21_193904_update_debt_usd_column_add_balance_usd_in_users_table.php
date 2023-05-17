<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDebtUsdColumnAddBalanceUsdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            try {
                DB::beginTransaction();
                DB::table('users')->update([
                    'debt_usd' => DB::raw('debt_usd + balance_usd'),
                ]);
            } catch (\Exception $e) {
               DB::rollBack();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
