<?php

namespace App\Http\Controllers\Backend;

use App\Models\Home\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Возвращает последение новости
     *
     * @return mixed
     */
    public static function getLasts()
    {
        return News::orderBy('created_at', 'asc')
            ->take(5)
            ->get();
    }
}
