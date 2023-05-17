<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Home\BauntyLink
 *
 * @property int $id
 * @property int $user_id
 * @property int $package_id
 * @property string $link
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\BauntyPackages $package
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\BauntyLink onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\BauntyLink withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\BauntyLink withoutTrashed()
 * @mixin \Eloquent
 */
class BauntyLink extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'user_id', 'package_id', 'status','link', 'deleted_at'
    ];
    protected $softDelete = true;


    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function package(){
    	return $this->belongsTo('App\Models\Home\BauntyPackages');
    }
}
