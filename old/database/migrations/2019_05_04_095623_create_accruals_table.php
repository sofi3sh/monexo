<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dok5\MigrationHelper\MigrationHelper;

class CreateAccrualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accruals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('percent', 5, 2)->comment('Начисленный процент');
            $comment = 'Дополнительные данные начисления.';
            if ((DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') && version_compare(DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION), '5.7.8', 'ge')) {
                $table->json('meta')->nullable()->comment($comment);
            } else {
                $table->text('meta')->nullable()->comment($comment);
            }
            $table->timestamp('start')->comment('Начали начисления');
            $table->timestamp('end')->comment('Закончили начисления');
            $table->text('comment')->nullable()->comment('Комментарий к начислению.');
            $table->timestamps();
        });

        MigrationHelper::addCommentToTable('accruals', 'Выполненные начисления.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accruals');
    }
}
