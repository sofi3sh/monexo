<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSurnameDateBirthdayAndCityToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'surname')) {
                $table->string('surname', 191)->nullable()->after('name')->comment('Фамилия');
            }

            $table->date('date_birthday')->nullable()->after('age')->comment('Дата рождения');
            $table->string('city', 191)->nullable()->after('country')->comment('Город');
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
            if (Schema::hasColumn('users', 'surname')) {
                $table->dropColumn('surname');
            }

            $table->dropColumn('date_birthday');
            $table->dropColumn('city');
        });
    }
}
