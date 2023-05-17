<?php

namespace App\Models\Admin;

use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuggestionType extends Model
{
    protected $table = 'suggestion_types';

    public $timestamps = false;

    protected $fillable = [
        'title_ru',
        'title_en'
    ];

    protected $appends = [
        'title'
    ];

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class, 'type_id', 'id');
    }

    public function getTitleAttribute($value)
    {
        $lang = app()->getLocale();
        switch ($lang) {
            case 'ru' :
                return $this->title_ru;
                break;

            case 'en' :
                return $this->title_en;
                break;

            default :
                return $this->title_en;
        }
    }
}
