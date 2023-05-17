<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\BookingDetail;

class AdminServicesController extends Controller
{
    public function index()
    {
        $listBookingDetail = BookingDetail::all();
        return view('admin.services', compact('listBookingDetail'));
    }
}
