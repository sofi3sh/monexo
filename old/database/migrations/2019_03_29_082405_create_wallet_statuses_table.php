<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateWalletStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru')->unique()->comment = "Название статуса.";
            $table->string('name_en')->unique();
            $table->string('name_de')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        MigrationHelper::addCommentToTable('wallet_statuses', 'Справочник статусов кошельков.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_statuses');
    }
}
