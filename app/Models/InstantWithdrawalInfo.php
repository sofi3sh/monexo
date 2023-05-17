<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class InstantWithdrawalInfo extends Model
{
    use HasTranslations;

    public $translatable = ['content', 'title'];

    protected $fillable = ['content', 'title'];
    
    protected $table = "instant_withdrawal_info";
    
}
