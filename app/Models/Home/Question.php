<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Consts\QuestionConstants;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'module_id',
        'question',
    ];

    protected $dates = ['deleted_at'];

    public function getModuleDescriptionAttribute()
    {
        if ( array_key_exists( $this->module_id, QuestionConstants::MODULE ) ) {
            return QuestionConstants::MODULE[ $this->module_id ];
        } else {
            return 'Выход за пределы диапазона';
        }

    }
}
