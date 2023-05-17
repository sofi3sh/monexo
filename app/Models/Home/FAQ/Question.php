<?php

namespace App\Models\Home\FAQ;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id ID
 * @property int $category_id ID категории
 * @property string $name Название вопроса
 * @property string $answer Ответ на вопрос
 * @property Carbon $created_at Вопрос создан
 * @property Carbon $updated_at Вопрос обновлен
 *
 * @property Category $category Категория
 *
 * @mixin Builder|Question|Question[]
 */
class Question extends Model
{
    use HasTranslations;

    /** @var string[] Переводимые колонки */
    public $translatable = ['name', 'answer'];

    /** @inheritDoc */
    protected $table = 'faq_questions';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'category_id',
        'name',
        'answer',
    ];

    /**
     * Категория
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
