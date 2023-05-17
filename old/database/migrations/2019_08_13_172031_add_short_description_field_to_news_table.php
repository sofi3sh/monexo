<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortDescriptionFieldToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->text('short_description_fr')->nullable(true)->after('header_fr');
            $table->text('short_description_pl')->nullable(true)->after('header_fr');
            $table->text('short_description_zh')->nullable(true)->after('header_fr');
            $table->text('short_description_de')->nullable(true)->after('header_fr');
            $table->text('short_description_en')->nullable(true)->after('header_fr');
            $table->text('short_description_ru')->nullable(true)->after('header_fr')->comment('Краткое описание новости');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'short_description')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('short_description');
            });
        };
    }
}
