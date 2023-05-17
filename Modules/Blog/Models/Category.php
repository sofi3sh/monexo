<?php

namespace Modules\Blog\Models;

use Modules\Blog\Models\Traits\HasSlug;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id ID
 * @property string $name Название
 * @property string $slug Уникальный семантический идентификатор
 * @property string $description Описание
 * @property string $color Цвет
 * @property Carbon $created_at Категория создана
 * @property Carbon $updated_at Категория обновлена
 *
 * @mixin Builder|Category|Category[]
 */
class Category extends Model
{
    use HasSlug;
    use HasTranslations;

    const MAX_NAME_LENGTH = 60;
    const MAX_SLUG_LENGTH = 60;
    const MAX_DESCRIPTION_LENGTH = 200;
    const MAX_COLOR_LENGTH = 30;

    const URGENT_NEWS_ID  = 2;


    /** @inheritDoc */
    protected $table = 'blog_categories';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
    ];

    public $translatable = ['name'];

    /**
     * Посты
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
