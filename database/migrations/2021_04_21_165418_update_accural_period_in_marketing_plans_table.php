<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAccuralPeriodInMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            if(Schema::hasColumn('marketing_plans', 'accrual_period')) {
                DB::table('marketing_plans')->whereIn('name', ['Business', 'Light'])->update([
                    'accrual_period' => 7
                ]);
            }
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
            if(Schema::hasColumn('marketing_plans', 'accrual_period')) {
                DB::table('marketing_plans')->whereIn('name', ['Business', 'Light'])->update([
                    'accrual_period' => 1
                ]);
            }
        });
    }
}
