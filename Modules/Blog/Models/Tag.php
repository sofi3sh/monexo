<?php

namespace Modules\Blog\Models;

use Modules\Blog\Models\Traits\HasSlug;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int $id ID
 * @property string $name Название
 * @property string $slug Уникальный семантический идентификатор
 * @property Carbon $created_at Тэг создан
 * @property Carbon $updated_at Тэг обновлен
 *
 * @mixin Builder|Tag|Tag[]
 */
class Tag extends Model
{
    use HasSlug;

    const MAX_NAME_LENGTH = 60;
    const MAX_SLUG_LENGTH = 60;

    /** @inheritDoc */
    protected $table = 'blog_tags';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'slug',
    ];

    /** @inheritDoc */
    protected $hidden = ['pivot'];
}
