<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Models\Home\Baunty
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Baunty extends Model
{
    protected $table = 'baunty';

    protected $fillable = ['title','text'];
}
