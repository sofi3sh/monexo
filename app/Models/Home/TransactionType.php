<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

/**
 * App\Models\Home\TransactionType
 *
 * @property int $id
 * @property string $name_ru Название типа транзакции.
 * @property string $name_en
 * @property string $name_de
 * @property string $name_zh
 * @property string $name_fr
 * @property string $name_pl
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNamePl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TransactionType extends Model
{
    /**
     * Возвращает название типа транзакции согласно текущей локализации
     *
     * @return mixed
     */
    public function transactionTypeName()
    {
        return $this->{ 'name_'.Lang::locale() };
    }
}
