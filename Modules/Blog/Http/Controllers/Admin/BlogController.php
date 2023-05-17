<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Страница
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.includes.partials.blog.index');
    }
}
