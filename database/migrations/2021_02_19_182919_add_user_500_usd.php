<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUser500Usd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::find(1183);
        if ($user) {
            $investedUsd = $user->invested_usd;
            if ( $investedUsd == 5500 ) {
                DB::statement('UPDATE users SET invested_usd = invested_usd + 500 where id = 1183');
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::find(1183);
        if ($user) {
            $investedUsd = $user->invested_usd;
            if ( $investedUsd == 5500 ) {
                DB::statement('UPDATE users SET invested_usd = invested_usd - 500 where id = 1183');
            }
        }
    }
}
