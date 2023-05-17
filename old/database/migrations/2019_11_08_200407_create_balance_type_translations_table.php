<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('balance_type_id');
            $table->string('locale')->index();
            $table->string('name')->comment('Название типа баланса на языке, заданном в поле locale');

            $table->unique(['balance_type_id', 'locale']);
            $table->foreign('balance_type_id')->references('id')->on('balance_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_types_translations');
    }
}
