<?php

use App\Models\UserStatusRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_status_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('ID пользователя');
            $table->unsignedBigInteger('user_status_id')->comment('ID статуса пользователя');
            $table->enum('request_status', [UserStatusRequest::ALL_STATUSES])->default(UserStatusRequest::STATUS_WAIT)->comment('Статус заявки');
            $table->json('extra_data')->nullable()->comment('Дополнительные данные');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_status_id')
                ->references('id')
                ->on('user_statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_status_requests');
    }
}
