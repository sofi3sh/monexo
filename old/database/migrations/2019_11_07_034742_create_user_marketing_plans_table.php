<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateUserMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('user_marketing_plans', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id')->comment('id маркетингового плана');
                $table->unsignedBigInteger('marketing_plan_id')->comment('id маркетингового плана');
                $table->float('invested_usd', 9, 2)->comment('Инвестированная в данный маркетинг план сумма');
                $table->float('profit_usd', 9, 2)->default(0)->comment('Полученная прибыль по маркетинговой программе');
                $table->float('partner_profit_usd', 9, 2)->default(0)->comment('Полученная прибыль по партнерской программе (по доходу партнера)');
                $table->float('coin_usd', 9, 2)->default(0)->comment('Сумма, удержанная на баланс для коина');
                $table->dateTime('start_at')->comment('Дата начала действия плана');
                $table->timestamp('end_at')->nullable(true)->comment('Дата окончания действия плана');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('marketing_plan_id')->references('id')->on('marketing_plans');
            });

            MigrationHelper::addCommentToTable('user_marketing_plans', 'Приобретенные пользователями маркетинговые планы');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_marketing_plans');
    }
}
