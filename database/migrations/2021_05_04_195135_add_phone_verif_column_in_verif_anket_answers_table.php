<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneVerifColumnInVerifAnketAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verif_anket_answers', function (Blueprint $table) {
            $table->boolean('phone_verif')->default(0)->after('user_id')->comment('Признак верификации по телефону');
            $table->string('document', 31)->nullable()->change();
            $table->string('photo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verif_anket_answers', function (Blueprint $table) {
            $table->dropColumn('phone_verif');
            $table->string('document', 31)->nullable(false)->change();
            $table->string('photo')->nullable(false)->change();
        });
    }
}
