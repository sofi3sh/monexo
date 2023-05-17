<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * App\Models\Home\BalanceType
 *
 * @property int $id
 * @property string|null $comment Комментарий
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Home\BalanceTypeTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Home\BalanceTypeTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType withTranslation()
 * @mixin \Eloquent
 */
class BalanceType extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name']; // Для чтения не используется
}
