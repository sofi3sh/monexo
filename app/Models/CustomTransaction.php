<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomTransaction extends Model
{
    protected $fillable = ['min', 'max', 'commission'];

}
