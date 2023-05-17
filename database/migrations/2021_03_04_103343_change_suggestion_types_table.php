<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSuggestionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggestion_types', function (Blueprint $table) {
            $table->renameColumn('title', 'title_ru');
            $table->string('title_en', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggestion_types', function (Blueprint $table) {
            $table->removeColumn('title_en');
            $table->renameColumn('title_ru', 'title');
        });
    }
}
