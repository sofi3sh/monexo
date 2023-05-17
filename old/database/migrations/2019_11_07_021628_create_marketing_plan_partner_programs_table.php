<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateMarketingPlanPartnerProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('marketing_plan_partner_programs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('marketing_plan_id')->comment('id маркетингового плана');
                $table->smallInteger('partner_program_id')->comment('id партнерской программы (id: 1 - от прибыли партнеров; 2 - от инвестиции партнеров)');
                $table->smallInteger('line_number')->comment('Номер линии маркетингового плана');
                $table->float('profit', 5, 2)->comment('% прибыли');
                $table->timestamps();
                $table->softDeletes();

                $table->unique(['marketing_plan_id', 'partner_program_id', 'line_number'], 'marketing_plan_partner_programs_plan_id_line_unique');
                $table->foreign('marketing_plan_id')->references('id')->on('marketing_plans');
            });

            MigrationHelper::addCommentToTable('marketing_plan_partner_programs', 'Партнерские программы маркетинговых планов');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketing_plan_partner_programs');
    }
}
