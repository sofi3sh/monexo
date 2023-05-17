<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('ip_registration', 15)->nullable()->index();
            $table->string('ip_last_auth', 15)->nullable()->index();
            $table->unsignedInteger('platform_id')->nullable();
            $table->unsignedInteger('browser_id')->nullable();
            $table->unsignedInteger('device_id')->nullable();
            $table->timestamps();
        });

        Schema::create('user_ip_platforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->unique();
        });

        Schema::create('user_ip_browsers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->unique();
        });

        Schema::create('user_ip_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->unique();
        });

        Schema::table('user_ips', function(Blueprint $table)
        {
            $table->foreign('user_id', 'user')
                ->references('id')
                ->on('users')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE');

            $table->foreign('platform_id', 'user_ip_platform')
                ->references('id')
                ->on('user_ip_platforms')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->foreign('device_id', 'user_ip_device')
                ->references('id')
                ->on('user_ip_devices')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->foreign('browser_id', 'user_ip_browser')
                ->references('id')
                ->on('user_ip_browsers')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });

        Schema::dropIfExists('fixip');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ips');
        Schema::dropIfExists('user_ip_platforms');
        Schema::dropIfExists('user_ip_browsers');
        Schema::dropIfExists('user_ip_devices');

        Schema::create('fixip', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('id пользователя');
            $table->string('ip', 128)->comment('ip адресс');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
