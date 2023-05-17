<?php

use Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->comment('ID категории');
            $table->unsignedBigInteger('author_id')->nullable()->comment('ID автора');
            $table->string('name', Post::MAX_NAME_LENGTH)->comment('Название');
            $table->string('slug', Post::MAX_SLUG_LENGTH)->unique()->comment('Уникальный семантический идентификатор');
            $table->string('excerpt', Post::MAX_EXCERPT_LENGTH)->comment('Отрывок');
            $table->string('image', Post::MAX_IMAGE_LENGTH)->nullable()->comment('Картинка');
            $table->text('content')->comment('Основной контент');
            $table->unsignedInteger('views')->default(0)->comment('Просмотры');
            $table->dateTime('published_at')->nullable()->comment('Опубликовано');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('blog_categories')
                ->onDelete('restrict');

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
