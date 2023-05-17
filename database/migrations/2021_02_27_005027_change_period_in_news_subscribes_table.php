<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePeriodInNewsSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_subscribes', function (Blueprint $table) {
            DB::statement("ALTER TABLE `news_subscribes` CHANGE `period` `period` ENUM('week','month','never') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Периодичность отправки писем'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_subscribes', function (Blueprint $table) {
            DB::statement("ALTER TABLE `news_subscribes` CHANGE `period` `period` ENUM('week','month') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Периодичность отправки писем'");
        });
    }
}
