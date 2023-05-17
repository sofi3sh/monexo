<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateMarketingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Название плана');
            $table->float('min_invest_sum', 8, 2)
                ->comment('Минимальная сумма инвестирования в пакет');
            $table->float('max_invest_sum', 8, 2)
                ->comment('Максимальная сумма инвестирования в пакет');
            $table->integer('min_duration')->comment('Минимальная длительность работы депозита, дн.');
            $table->integer('max_duration')->comment('Максимальная длительность работы депозита, дн.');
            $table->boolean('only_business_days')->comment('Признак, что начислять только в рабочие дни');
            $table->float('min_profit', 5, 2)->comment('Минимальная прибыль');
            $table->float('max_profit', 5, 2)->comment('Максимальная прибыль');
            $table->float('min_withdrawal_request', 5, 2)->comment('Ограничение на создание заявки на вывод при активном плане');
            $table->float('coin_percent', 5, 2)->comment('% прибыли, который переводится на счет коина');
            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('marketing_plans', 'Маркетинговые планы');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketing_plans');
    }
}
