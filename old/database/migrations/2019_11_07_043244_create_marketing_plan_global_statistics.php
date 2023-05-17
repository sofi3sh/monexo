<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateMarketingPlanGlobalStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('marketing_plan_global_statistics', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name_ru')->comment('Название параметра');
                $table->string('name_en');
                $table->string('value')->comment('Значение');
                $table->string('comment')->nullable(true)->comment('Комментарий к параметру');
                $table->timestamps();
                $table->softDeletes();
            });

            MigrationHelper::addCommentToTable('marketing_plan_global_statistics', 'Глобальная статистика по маркетинговым планам');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketing_plan_global_statistics');
    }
}
