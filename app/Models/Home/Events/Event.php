<?php

namespace App\Models\Home\Events;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id ID
 * @property string $name Название события
 * @property Carbon $start Дата события
 * @property string $presenter имя ведущего
 * @property string $duration длительность события
 * @property string $details детали
 * @property string $price цена
 * @property Carbon $created_at Событие создано
 * @property Carbon $updated_at Событие обновлено
 *
 *
 * @mixin Builder|Event|Event[]
 */
class Event extends Model
{
    use HasTranslations;

    /** @var string[] Переводимые колонки */
    public $translatable = ['name', 'details', 'duration', 'presenter'];

    /** @inheritDoc */
    protected $table = 'events';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'start',
        'presenter',
        'duration',
        'details',
        'price'
    ];
}
