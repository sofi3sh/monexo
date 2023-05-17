<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlockchainAddrToCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->string('blockchain_addr')->nullable(true)
                ->after('is_crypto')
                ->comment('Адрес блокчена для проверки транзакции.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('currencies', 'blockchain_addr')) {
            Schema::table('currencies', function (Blueprint $table) {
                $table->dropColumn('blockchain_addr');
            });
        }
    }
}
