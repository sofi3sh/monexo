<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditManualPercentInMarketingPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->dropColumn('manual_percent');
        });

        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->string('manual_percent', 128)->after('max_profit')->nullable();
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
            $table->dropColumn('manual_percent');
        });

        Schema::table('marketing_plans', function (Blueprint $table) {
            $table->double('manual_percent', 4, 2)->after('max_profit')->nullable();
        });
    }
}
