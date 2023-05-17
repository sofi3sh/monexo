<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateReferralAccrualParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_accrual_params', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level')->comment('Уровень реферала.');
            $table->bigInteger('transaction_type_id')->unsigned()->comment('id типа транзакции');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->integer('percent')->comment('Процент от дохода реферала конкретного уровня, который получает рефер.');
            $table->boolean('accrue')->default(1)->comment('Надо ли начислять прибыль по данному уровню.');
            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('referral_accrual_params', 'Параметры начислений реферам от дохода рефералов разных уровней.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_accrual_params');
    }
}
