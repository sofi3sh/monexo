<?php

namespace App\Models\Home;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Support\Carbon;

/**
 * @property int $id ID
 * @property string $text Текст цитаты
 * @property string $author Автор цитаты
 * @property Carbon $created_at Дата и время создания
 * @property Carbon $updated_at Дата и время изменения
 *
 * @mixin Builder|Quote|Quote[]
 */
class Quote extends Model
{
    use HasTranslations;

    /** @var string[] Переводимые колонки */
    public $translatable = ['text', 'author'];

    /** @inheritDoc */
    protected $table = 'quotes';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = ['text', 'author'];
}
