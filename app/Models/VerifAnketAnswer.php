<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class VerifAnketAnswer extends Model
{
    const MULTI_ACCOUNT = 3;

    protected $fillable = [
        'surname', 
        'name', 
        'birthday',
        'phone_anket',
        'document',
        'photo',
        'multi_accounts',
        'is_check',
        'user_id',
        'phone_verif',
        'created_at', 
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPhotoAttribute($value): ?string
    {
        return url(Storage::url($value));
    }

    public function getMultiAccountsAnswer() {
        switch($this->multi_accounts)
        {
            case 1: return 'Я создал только один аккаунт - свой.';
            case 2: return 'Я помогал в регистрации и создал несколько аккаунтов, но для себя - только один.';
            case 3: return 'Да, создал для себя более одного и не знал, что так делать нельзя.';
            case 4: return 'Мой аккаунт создал для меня другой человек.';
        }
    }

}
