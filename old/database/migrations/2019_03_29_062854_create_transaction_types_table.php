<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru')->unique()->comment = "Название типа транзакции.";
            $table->string('name_en')->unique();
            $table->string('name_de')->unique();

            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('transaction_types', 'Справочник типов транзакций.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_types');
    }
}
