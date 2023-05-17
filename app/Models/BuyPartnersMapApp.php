<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyPartnersMapApp extends Model
{
    protected $fillable = ['telegram', 'city', 'user_id', 'status', 'is_active', 'purchase_date', 'price_of_sub'];

    public const STATUS_END_OF_SUB = 2;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullInfo()
    {
        $user = $this->user;
        return "Имя: $user->name\nФамилия: $user->surname\nTelegram: $this->telegram\nEmail: $user->email\nГород(с формы): $this->city\nГород (в системе): $user->city\nТелефон: $user->phone";
    }

    public function getHumanStatus($value) 
    {
        $map = ['Не обработана', 'Обработана', 'Закончилась подписка'];
        return $map[$value];
    }
}
