<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->comment('Название параметра');
            $table->string('value')->comment('Значение параметра');
            $table->string('comment')->nullable(true)->comment('Комментарий');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_statistics');
    }
}
