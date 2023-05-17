<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifAnketAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verif_anket_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surname');
            $table->string('name');
            $table->date('birthday');
            $table->string('phone_anket', 31);
            $table->string('document', 31);
            $table->string('photo');
            $table->tinyInteger('multi_accounts');

            
            $table->boolean('is_check')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verif_anket_answers');
    }
}
