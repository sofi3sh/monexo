<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawCommissionSettings extends Model
{
    protected $table = 'withdraw_commission_settings';

    protected $fillable = ['period', 'commission'];

    public const DAYS_7 = 1, DAYS_14 = 2, DAYS_30 = 3, DAYS_0 = 4;

    public static function getCommissions() 
    {
        return static::all()->pluck('commission', 'period');
    }
}
