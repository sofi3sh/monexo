<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public $table = 'maps';
    protected $fillable = ['code', 'show'];
}
