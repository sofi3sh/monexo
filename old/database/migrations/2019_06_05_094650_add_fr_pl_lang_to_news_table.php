<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFrPlLangToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('header_fr')->after('header_zh');
            $table->string('header_pl')->after('header_zh');
            $table->string('text_fr')->after('text_zh');
            $table->string('text_pl')->after('text_zh');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('news', 'header_fr')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('header_fr');
            });
        }

        if (Schema::hasColumn('news', 'header_pl')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('header_pl');
            });
        }

        if (Schema::hasColumn('news', 'text_fr')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('text_fr');
            });
        }

        if (Schema::hasColumn('news', 'text_pl')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('text_pl');
            });
        }

    }
}
