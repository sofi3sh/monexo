<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 127)->comment('Название материала');
            $table->string('pdf', 255)->comment('Ссылка на pdf');;
            $table->text('describe')->comment('Описание материала');;;
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
        Schema::dropIfExists('company_materials');
    }
}
