<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class NewsSubscribesSetting extends Model
{
    protected $fillable = ['week_day', 'month_day', 'week_dispatch_time', 'month_dispatch_time'];

    public function getDayOfWeek() {
        $days = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
        return $days[$this->week_day];
    }

    public function getWeekDispatchTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }
    
    public function getMonthDispatchTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

}
