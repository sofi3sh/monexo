<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertInBodyOnValuesInMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_plans', function (Blueprint $table) {
            if(Schema::hasColumn('marketing_plans', 'body_on')) {

                // Тело включено в выплаты
                DB::table('marketing_plans')->whereIn('name', [
                    'Business',
                    'Light',
                ])->update([
                    'body_on' => 1
                ]);

                // Тело НЕ включено в выплаты
                DB::table('marketing_plans')->whereIn('name', [
                    'Start',
                    'Profi',
                    'Optimus',
                    'President',
                    'Mini'
                ])->orWhere('name', 'like', '%Standard%')->update([
                    'body_on' => 0
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
            // Тело включено в выплаты
            DB::table('marketing_plans')->whereIn('name', [
                'Business',
                'Light',
            ])->update([
                'body_on' => null
            ]);

            // Тело НЕ включено в выплаты
            DB::table('marketing_plans')->whereIn('name', [
                'Start',
                'Profi',
                'Optimus',
                'President',
                'Mini'
            ])->orWhere('name', 'like', 'Standard')->update([
                'body_on' => null
            ]);
        });
    }
}
