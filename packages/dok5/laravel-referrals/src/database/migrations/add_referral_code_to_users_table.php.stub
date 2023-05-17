<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Auth\User;
use Illuminate\Support\Str;

class AddReferralCodeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::beginTransaction();
            Schema::table('users', function (Blueprint $table) {
                $table->string(config('referrals.fields.referralCode.name'))
                    ->after(config('referrals.fields.referralCode.after'))
                    ->nullable()->unique()
                    ->comment = config('referrals.fields.referralCode.comment');
                $table->integer(config('referrals.fields.referredByUserId.name'))
                    ->after(config('referrals.fields.referredByUserId.after'))
                    ->unsigned()
                    ->nullable()
                    ->comment = config('referrals.fields.referredByUserId.comment');
                $table->foreign(config('referrals.fields.referredByUserId.name'))->references('id')->on('users');
            });

            // Заполняем реферальными ссылками
            $users = User::all();
            foreach ($users as $user) {
                $user[config('referrals.fields.referralCode.name')] = Str::random(config('referrals.referralLength'), 'alpha');
                $user->save();
            }

            Schema::table('users', function (Blueprint $table) {
                // Убираем nullable
                $table->string('refer_id')->nullable(false)->change();
            });
        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('error', $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(config('referrals.fields.referralCode.name'));
            $table->dropColumn(config('referrals.fields.referredByUserId.name'));
        });
    }
}
