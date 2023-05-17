<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Models\Home\News
 *
 * @property int $id
 * @property string $header_ru Заголовок новости
 * @property string $header_en
 * @property string $header_de
 * @property string $header_zh
 * @property string $header_pl
 * @property string $header_fr
 * @property string|null $short_description_ru Краткое описание новости
 * @property string|null $short_description_en
 * @property string|null $short_description_de
 * @property string|null $short_description_zh
 * @property string|null $short_description_pl
 * @property string|null $short_description_fr
 * @property string $text_ru Текст новости
 * @property string $text_en
 * @property string $text_de
 * @property string $text_zh
 * @property string $text_pl
 * @property string $text_fr
 * @property string|null $thumb
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\News withoutTrashed()
 * @mixin \Eloquent
 */
class News extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'news';

    protected $fillable = ['header_ru', 'header_en', 'header_de', 'text_ru', 'text_ru', 'text_en', 'text_de',
        'text_zh', 'text_zh', 'text_fr', 'text_pl'];

    /**
     * Возвращает следующий id в таблице
     *
     * @return int
     */
    public function getNextId()
    {
        $statement = DB::select("show table status like 'news'");

        return (int) $statement[0]->Auto_increment;
    }

    /**
     * Преобразовываем к нужному разрешению превью новости
     *
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(250)
            ->height(250)
            ->nonQueued();
    }
}
