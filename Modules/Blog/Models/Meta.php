<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int $id ID
 * @property int $post_id ID поста
 * @property string $description Описание
 * @property string $keywords Ключевые слова
 *
 * @mixin Builder|Meta|Meta[]
 */
class Meta extends Model
{
    const MAX_DESCRIPTION_LENGTH = 250;
    const MAX_KEYWORDS_LENGTH = 100;

    /** @inheritDoc */
    protected $table = 'blog_metas';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    public $timestamps = false;

    /** @inheritDoc */
    protected $fillable = [
        'post_id',
        'description',
        'keywords',
    ];

    /** @inheritDoc */
    protected $hidden = ['post_id'];
}
