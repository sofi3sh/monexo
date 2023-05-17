<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBlogPostsSetAuthorId22WhereNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            DB::UPDATE('UPDATE blog_posts SET author_id=22  WHERE author_id is null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            DB::UPDATE('UPDATE blog_posts SET author_id=NULL  WHERE author_id=22 ORDER BY created_at limit 1');
        });
    }
}
