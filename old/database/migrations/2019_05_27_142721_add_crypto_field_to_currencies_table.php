<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCryptoFieldToCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->boolean('is_crypto')
                ->default(true)
                ->after('show_rate_on_landing')
                ->comment('Признак, что это криптовалюта. Пошли костыли, чтобы подключить плат. системы.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('currencies', 'is_crypto')) {
            Schema::table('currencies', function (Blueprint $table) {
                $table->dropColumn('is_crypto');
            });
        };
    }
}
