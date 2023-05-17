<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsSubscribe;
use App\Models\NewsSubscribesSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Response;

class NewsEmailController extends Controller
{
    
    public function index() {
        $subscribes = NewsSubscribe::all();
        $settings = NewsSubscribesSetting::find(1);
        return view('admin.newsSubscribtion.index', compact('subscribes', 'settings'));
    }
    
    public function edit() {
        $settings = NewsSubscribesSetting::find(1);
        return view('admin.newsSubscribtion.edit', compact('settings'));
    }

    public function update(Request $request) {
        
        $validatedData = $request->validate([
            'week_day' => 'required|integer|min:0|max:6',
            'month_day' => 'required|integer|min:1|max:31',
            'week_dispatch_time' => 'date_format:H:i|required',
            'month_dispatch_time' => 'date_format:H:i|required',
        ]);

        $settings = NewsSubscribesSetting::find(1);

        DB::beginTransaction();
        try {
            $settings->week_day = $validatedData['week_day'];
            $settings->month_day = $validatedData['month_day'];
            $settings->week_dispatch_time = $validatedData['week_dispatch_time'] . ':00';
            $settings->month_dispatch_time = $validatedData['month_dispatch_time'] . ':00';
            $settings->save();
            DB::commit();            
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        return redirect()->route('admin.news-subscribes.index');
    }

    public function emailsCsv()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=emails.txt",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        
        $subs = NewsSubscribe::select('email')->get();
        $columns = array('emails');

        $callback = function() use ($subs, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach($subs as $sub) {
                fputcsv($file, array($sub->email));
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);

    }

}
