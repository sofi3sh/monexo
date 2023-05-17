<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMotivationPlanStartAtFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('motivation_plan_start_at')
                ->nullable(true)
                ->after('motivation_plan_id')
                ->comment('Дата начала действия мотивационного плана');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'motivation_plan_start_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('motivation_plan_start_at');
            });
        };
    }
}
