<?php

namespace Modules\Blog\Models;

use App\Models\User;
use Modules\Blog\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Support\{Collection, Str, Carbon};
use Illuminate\Support\Facades\{Route, Storage};
use Illuminate\Database\Eloquent\Relations\{HasOne, BelongsTo, BelongsToMany};
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id ID
 * @property int $category_id ID категории
 * @property int $author_id ID автора
 * @property string $name Название
 * @property string $slug Уникальный семантический идентификатор
 * @property string $excerpt Отрывок
 * @property string $image Картинка
 * @property string $content Основной контент
 * @property int $views Просмотры
 * @property Carbon $published_at Пост опубликован
 * @property Carbon $created_at Пост создан
 * @property Carbon $updated_at Пост обновлен
 *
 * @property string $tags_string Строка тегов
 * @property string $formatted_published_at Форматированная дата публикации
 *
 * @property User $author Автор
 * @property Category $category Категория
 * @property array|Collection|Tag[] $tags Теги
 * @property Meta $meta Метатеги
 *
 * @method static Builder published() Только опубликованные
 *
 * @mixin Builder|Post|Post[]
 */
class Post extends Model
{
    use HasSlug;
    use HasTranslations;

    /** @inheritDoc */
    protected $table = 'blog_posts';

    public $translatable = ['name', 'content'];

    const MAX_NAME_LENGTH = 100;
    const MAX_SLUG_LENGTH = 100;
    const MAX_EXCERPT_LENGTH = 250;
    const MAX_IMAGE_LENGTH = 200;
    
    public const URGENT_NEWS_ID = 2;

    const DEFAULT_IMAGE = 'img/dinway.jpeg';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'category_id',
        'author_id',
        'name',
        'slug',
        'image',
        'content',
        'views',
        'published_at',
    ];

    /** @inheritDoc */
    protected $casts = [
        'published_at' => 'datetime:d.m.Y H:i',
        'created_at' => 'datetime:d.m.Y H:i',
        'updated_at' => 'datetime:d.m.Y H:i',
    ];

    /**
     * Получить полный путь к картинке
     *
     * @param $value
     * @return string|null
     */
    public function getImageAttribute($value): ?string
    {
        return $value ? url(Storage::url($value)) : $this->getDefaultImage();
    }

    /**
     * Получить строку тегов
     *
     * @return string
     */
    public function getTagsStringAttribute(): string
    {
        if (!$this->tags) {
            return '';
        }

        return $this->tags->pipe(function ($tags) {
            $string = '';

            foreach ($tags as &$tag) {
                if ($string) $string .= ' ';

                $string .= '#' . $tag->name;

                unset($tag);
            }

            return $string;
        });
    }

    /**
     * Получить форматиронную дату публикации
     *
     * @return string
     */
    public function getFormattedPublishedAtAttribute(): ?string
    {
        if (!$this->published_at) {
            return null;
        }

        return $this->published_at->format('d.m.Y H:i');
    }

    /**
     * Опубликован?
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        return (bool)$this->published_at;
    }

    /**
     * Публиковать
     *
     * @return $this
     */
    public function publish(): self
    {
        $this->published_at = now();

        return $this;
    }

    /**
     * Отменить публикацию
     *
     * @return $this
     */
    public function cancelPublication(): self
    {
        $this->published_at = null;

        return $this;
    }

    /**
     * Автор
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Категория
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Теги
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blog_post_tag');
    }

    /**
     * Метатеги
     *
     * @return HasOne
     */
    public function meta(): HasOne
    {
        return $this->hasOne(Meta::class);
    }

    /**
     * Только опубликованные
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        $query->whereNotNull('published_at');

        return $query;
    }


    public function getExcerptAttribute() {
        $content = self::find($this->id)->content;
        return Str::limit($content, self::MAX_EXCERPT_LENGTH);
    }

    /**
     * В админке сейчас?
     *
     * @return bool
     */
    private function inAdminAreaNow(): bool // убрал из получения картинки, хз зачем проверять на админку чтобы дефолт изображение вернуть
    {
        static $bool;

        if (!is_bool($bool)) {
            $bool = in_array('admin', Route::getCurrentRoute()->middleware());
        }

        return $bool;
    }

    /**
     * Получить картинку по умолчанию
     *
     * @return string|null
     */
    private function getDefaultImage(): ?string
    {
        return url(self::DEFAULT_IMAGE);
    }
}
