<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\User;

class AddNestedsetFieldsToUsersTable extends Migration
{
    use NodeTrait;

    public function getLftName()
    {
        return 'left_id';
    }

    public function getRgtName()
    {
        return 'right_id';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Поле может быть создано компонентом laravel-referrals
            if (!Schema::hasColumn('users', NestedSet::PARENT_ID)) {
                $table->unsignedInteger(NestedSet::PARENT_ID)->nullable()->after('email_verified_at');
            }

            $table->unsignedInteger($this->getRgtName())->default(0)->after(NestedSet::PARENT_ID);
            $table->unsignedInteger($this->getLftName())->default(0)->after($this->getRgtName());

            $table->index([$this->getRgtName(), $this->getLftName(), NestedSet::PARENT_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex([$this->getRgtName(), $this->getLftName(), $this->getParentIdName()]);
            $table->dropColumn([$this->getRgtName(), $this->getLftName()]);
            // todo Не понимаю почему, но здесь уже этого поля нет и вызывается исключение.
            /// $table->dropColumn($this->getParentIdName());
        });
    }
}
