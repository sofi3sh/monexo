<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtsTransferSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts_transfer_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('percent', 5, 2)->comment('Максимальный процент вывода на основной счет от первоначального долга перед пользователем');
            $table->float('min');
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
        Schema::dropIfExists('debts_transfer_settings');
    }
}
