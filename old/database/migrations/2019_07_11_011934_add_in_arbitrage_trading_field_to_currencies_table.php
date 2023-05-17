<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInArbitrageTradingFieldToCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->boolean('in_arbitrage_trading')
                ->default(false)
                ->after('is_crypto')
                ->comment('Признак, что криптовалюта доступна в арбитражной торговле.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('currencies', 'in_arbitrage_trading')) {
            Schema::table('currencies', function (Blueprint $table) {
                $table->dropColumn('in_arbitrage_trading');
            });
        };
    }
}
