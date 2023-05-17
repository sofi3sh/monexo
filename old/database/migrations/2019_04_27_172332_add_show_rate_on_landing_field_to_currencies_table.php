<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowRateOnLandingFieldToCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->boolean('show_rate_on_landing')
                ->default(false)
                ->after('withdrawal_allowed')
                ->comment = 'Признак, надо или нет показывать этот курс на лендинге.';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currencies', function (Blueprint $table) {
            if (Schema::hasColumn('currencies', 'show_rate_on_landing')) {
                Schema::table('currencies', function (Blueprint $table) {
                    $table->dropColumn('show_rate_on_landing');
                });
            }
        });
    }
}
