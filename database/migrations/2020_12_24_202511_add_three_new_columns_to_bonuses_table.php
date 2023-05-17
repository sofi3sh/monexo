<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThreeNewColumnsToBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bonuses', function (Blueprint $table) {
            $table->boolean('is_regional_representative_status_available')
                ->default(false)
                ->comment('Доступен ли статус регионального представителя')
                ->after('matching_bonus');

            $table->boolean('is_invitation_deposit_available')
                ->default(false)
                ->comment('Доступен ли пригласительный депозит')
                ->after('matching_bonus');

            $table->decimal('leadership_bonus', 5)
                ->nullable()
                ->comment('Лидерский бонус')
                ->after('matching_bonus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bonuses', function (Blueprint $table) {
            $table->dropColumn('is_regional_representative_status_available');
            $table->dropColumn('is_invitation_deposit_available');
            $table->dropColumn('leadership_bonus');
        });
    }
}
