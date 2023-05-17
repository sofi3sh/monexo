<?php

namespace App\Models\Home\FAQ;

use Spatie\Translatable\HasTranslations;
use Illuminate\Support\{Collection, Carbon};
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id ID
 * @property string $name Название
 * @property string $description Описание
 * @property Carbon $created_at Категория создана
 * @property Carbon $updated_at Категория обновлена
 *
 * @property array|Collection|Question[] $questions Вопросы
 *
 * @mixin Builder|Category|Category[]
 */
class Category extends Model
{
    use HasTranslations;

    /** @var string[] Переводимые колонки */
    public $translatable = ['name'];

    /** @inheritDoc */
    protected $table = 'faq_categories';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Вопросы
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
