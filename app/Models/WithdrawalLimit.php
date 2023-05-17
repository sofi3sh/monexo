<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalLimit extends Model
{
    protected $fillable = ['name', 'value'];

    public function getNameAttribute(string $value)
    {
        switch($value) {
            case 'card': return 'Карта';
            break;
        }
    }
}
