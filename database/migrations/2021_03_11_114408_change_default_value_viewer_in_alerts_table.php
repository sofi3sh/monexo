<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValueViewerInAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alerts', function (Blueprint $table) {
            DB::statement("ALTER TABLE `alerts` CHANGE `viewed` `viewed` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Индикатор прочитанности';");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alerts', function (Blueprint $table) {
            DB::statement("ALTER TABLE `alerts` CHANGE `viewed` `viewed` TINYINT(0) NOT NULL DEFAULT '0' COMMENT 'Индикатор прочитанности';");
        });
    }
}
