<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ViewController extends Controller
{
    /**
     * Страница
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.includes.partials.faq.index');
    }
}
