<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestion_types', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 128)->nullable();
        });

        Schema::create('suggestions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128)->nullable();
            $table->text('text');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_moderated')->default(false);
            $table->unsignedSmallInteger('type_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->foreign('type_id')
                ->references('id')
                ->on('suggestion_types')
                ->onDelete('SET NULL');
        });

        Schema::create('suggestion_likes', function (Blueprint $table) {
            $table->unsignedInteger('suggestion_id');
            $table->unsignedBigInteger('user_id');

            $table->primary(['suggestion_id', 'user_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->foreign('suggestion_id')
                ->references('id')
                ->on('suggestions')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggestion_likes');
        Schema::dropIfExists('suggestions');
        Schema::dropIfExists('suggestion_types');
    }
}
