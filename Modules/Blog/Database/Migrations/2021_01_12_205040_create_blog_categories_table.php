<?php

use Modules\Blog\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', Category::MAX_NAME_LENGTH)->comment('Название');
            $table->string('slug', Category::MAX_SLUG_LENGTH)->unique()->comment('Уникальный семантический идентификатор');
            $table->string('description', Category::MAX_DESCRIPTION_LENGTH)->nullable()->comment('Описание');
            $table->string('color', Category::MAX_COLOR_LENGTH)->default('inherit')->comment('Цвет');
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
        Schema::dropIfExists('blog_categories');
    }
}
