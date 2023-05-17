<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\RegulationsService;
use Illuminate\Http\Request;

class RegulationsController extends Controller
{
    public function index()
    {
        $sections = RegulationsService::getSections();

        return view('dashboard.regulations.regulations-index', compact('sections'));
    }
}
