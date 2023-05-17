<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameZhFieldToTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_types', function (Blueprint $table) {
            $table->string('name_zh')->after('name_de');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_types', function (Blueprint $table) {
            if (Schema::hasColumn('transaction_types', 'name_zh')) {
                Schema::table('transaction_types', function (Blueprint $table) {
                    $table->dropColumn('name_zh');
                });
            };
        });
    }
}
