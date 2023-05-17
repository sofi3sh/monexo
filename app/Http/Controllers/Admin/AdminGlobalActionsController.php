<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;
use DeviceDetector\Parser\Device\Console;
use Session;

class AdminGlobalActionsController extends Controller
{
    public function show()
    {
        return view('admin.global-actions.show');
    }

    public function down() 
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        Artisan::call('down', [
            '--allow' => $ip
        ]);
        
        Session::flash('success', "Сайт упал! Он доступен только вам, доступ по ip $ip");

        return redirect()->back();
    }

    public function up() 
    {
        Artisan::call('up');
        Session::flash('success', 'Сайт поднялся!');
        return redirect()->back();
    }
}
