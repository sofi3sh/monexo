<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en', 255)->comment('Техническое английское название. Слаг.');
            $table->string('name_ru', 255)->comment('Название услуги на русском');
            $table->string('name_english', 255)->nullable()->comment('Название услуги на английском');
            $table->decimal('price_usd', 19, 2)->comment('Цена на услугу в долларах');
            $table->bigInteger('services_category_id')->unsigned()->comment('id категории услуги');
            $table->boolean('is_active')->default(1)->comment('0 - услуга не активна, 1 - активна');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('name_en', 'services_name_en_unique');
            $table->foreign('services_category_id')->references('id')->on('services_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
