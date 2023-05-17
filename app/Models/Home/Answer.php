<?php

namespace App\Models\Home;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'question_id',
        'answer',
    ];

    protected $dates = ['deleted_at'];

    protected $table = 'answer';
}
