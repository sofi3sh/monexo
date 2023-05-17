<?php

namespace App\Http\Controllers\Admin\CompanyMaterials;

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
        return view('admin.includes.partials.companyMaterials.index');
    }
}
