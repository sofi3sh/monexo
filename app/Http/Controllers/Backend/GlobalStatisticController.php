<?php

namespace App\Http\Controllers\Backend;

use App\Models\Home\GlobalStatistics;
use App\Http\Controllers\Controller;

class GlobalStatisticController extends Controller
{
    /**
     * Возвращает массив данных глобальной статистики
     *
     * @return array
     */
    public static function get()
    {
        return GlobalStatistics::all()->pluck('value')->toArray();
    }
}
