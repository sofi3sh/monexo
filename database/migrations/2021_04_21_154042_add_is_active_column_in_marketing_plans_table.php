<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveColumnInMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->boolean('is_active')->after('name')->default(0)->comment('Активен ли пакет');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
