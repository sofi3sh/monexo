<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BuyPartnersMapSetting extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'text_info'];
    protected $fillable = ['title', 'text_info', 'price', 'level'];
}
