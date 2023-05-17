<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Home\News;
use Illuminate\View\View;

class NewsPageController extends Controller
{
    /**
     * Отображает страницу Новости.
     *
     * @return Illuminate\View\View
     */
    public function showNewsPage(): View
    {

        $news = News::orderBy('id', 'desc')->get([
            'id',
            'header_' . app()->getLocale() . ' as header',
            'text_' . app()->getLocale() . ' as text',
            'short_description_' . app()->getLocale() . ' as short_description',
            'created_at'
        ]);

        return view('backend.pages.news')->with([
            'news' => $news
        ]);
    }
}
