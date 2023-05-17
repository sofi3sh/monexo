<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedAtFieldToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('jobs', 'created_at')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->dropColumn('created_at');
            });
        };

        if (Schema::hasColumn('jobs', 'updated_at')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->dropColumn('updated_at');
            });
        };
    }
}
