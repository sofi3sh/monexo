<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevertTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revert_transaction', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('user_id');
            $table->integer('marketing_plan_id');
            $table->integer('user_marketing_plan_id');
            $table->decimal('amount_usd', 15, 8);
            $table->decimal('amount_btc', 15, 8);
            $table->decimal('amount_eth', 15, 8);
            $table->decimal('amount_pzm', 15, 8);
            $table->integer('days_left');

            $table->boolean('updated')->default(false);

            $table->decimal('was_balance_usd', 15, 8);
            $table->decimal('was_balance_btc', 15, 8);
            $table->decimal('was_balance_eth', 15, 8);
            $table->decimal('was_balance_pzm', 15, 8);
            $table->decimal('was_profit_usd', 15, 8);
            $table->decimal('was_profit_btc', 15, 8);
            $table->decimal('was_profit_eth', 15, 8);
            $table->decimal('was_profit_pzm', 15, 8);
            $table->integer('was_days_left');

            $table->decimal('new_balance_usd', 15, 8);
            $table->decimal('new_balance_btc', 15, 8);
            $table->decimal('new_balance_eth', 15, 8);
            $table->decimal('new_balance_pzm', 15, 8);
            $table->decimal('new_profit_usd', 15, 8);
            $table->decimal('new_profit_btc', 15, 8);
            $table->decimal('new_profit_eth', 15, 8);
            $table->decimal('new_profit_pzm', 15, 8);
            $table->integer('new_days_left');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revert_transaction');
    }
}
