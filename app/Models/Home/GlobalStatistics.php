<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\GlobalStatistics
 *
 * @property int $id
 * @property string $name Название параметра
 * @property string $value Значение параметра
 * @property string|null $comment Комментарий
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereValue($value)
 * @mixin \Eloquent
 */
class GlobalStatistics extends Model
{
    protected $fillable=['name', 'value', 'comment'];
}
