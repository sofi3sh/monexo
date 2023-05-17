<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Config
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Config query()
 * @mixin \Eloquent
 */
class Config extends Model
{
    protected $fillable = [
        'name', 'value',
    ];
}
