<?php

namespace Dok5\MigrationHelper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MigrationHelper
{
    /**
     *
     *
     * @param Blueprint $table
     * @param string|null $addAfterField
     * @param bool $isNullable
     */
    public static function addEditorIdField(Blueprint $table, string $addAfterField = null)
    {
        try {
            DB::beginTransaction();
            if (!is_null($addAfterField)) {
                $table->bigInteger('editor_id')
                    ->unsigned()
                    ->nullable()
                    ->after($addAfterField)
                    ->comment('id пользователя, выполнившего правки.');
            } else {
                $table->bigInteger('editor_id')
                    ->unsigned()
                    ->nullable()
                    ->comment('id пользователя, выполнившего правки.');
            }
            $table->foreign('editor_id')->references('id')->on('users');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    /**
     *
     * @param Blueprint $table
     */
    public static function deleteEditorIdField(Blueprint $table)
    {
        if (Schema::hasColumn('users', 'editor_id')) {
            Schema::table('users', function (Blueprint $table) {
                try {
                    DB::beginTransaction();
                    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
                    $table->dropForeign('users_editor_id_foreign');
                    $table->dropColumn('editor_id');
                    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    dd($e->getMessage());
                }
            });
        }
    }

    /**
     * Добавить комментарий к таблице.
     *
     * @param string $tableName Название таблицы.
     * @param string $comment Комментарий.
     */
    public static function addCommentToTable($tableName, $comment)
    {
        DB::statement("ALTER TABLE `$tableName` comment '" . $comment . "'");
    }

    /**
     * Удаляет поле с предварительной проверкой на существование.
     *
     * @param string $tableName Название таблицы.
     * @param string $columnName Название поля.
     */
    public static function dropColumnIfExists($tableName, $columnName)
    {
        if (Schema::hasColumn($tableName, $columnName)) {
            Schema::table($tableName, function (Blueprint $table, $columnName) {
                $table->dropColumn($columnName);
            });
        }
    }

}
