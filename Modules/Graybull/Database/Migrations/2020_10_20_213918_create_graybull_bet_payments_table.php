<?php

use Modules\Graybull\Models\BetPayment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraybullBetPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graybull_bet_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bet_id')->comment('ID ставки');
            $table->enum('type', BetPayment::ALL_TYPES)->comment('Тип выплаты');
            $table->decimal('percentage', 15, 8)->comment('Процент на момент выплаты');
            $table->decimal('amount_usd', 15, 8)->comment('Сумма выплаты в USD');
            $table->timestamp('created_at', 0)->comment('Выплата создана');

            $table->foreign('bet_id')
                ->references('id')
                ->on('graybull_bets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graybull_bet_payments');
    }
}
