<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\BalanceTypeTranslation
 *
 * @property int $id
 * @property int $balance_type_id
 * @property string $locale
 * @property string $name Название типа баланса на языке, заданном в поле locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereBalanceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereName($value)
 * @mixin \Eloquent
 */
class BalanceTypeTranslation extends Model
{
    //
}
