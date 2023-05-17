<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIsMentorOnAppealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appeal', function (Blueprint $table) {
            $table->boolean('is_mentor')
                ->after('descr')
                ->default(0)
                ->comment('1 - тип обращения уходит наставнику, 0 - нет');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('appeal', 'с')) {
            Schema::table('appeal', function (Blueprint $table) {
                $table->dropColumn('appeal');
            });
        }
    }
}
