<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraybullController extends Controller
{
    public function index(){
    	return view('backend.pages.graybull');
    }
}
