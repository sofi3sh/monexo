<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Backend\GlobalStatisticController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\GlobalStatistics;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminGlobalStatisticController extends Controller
{
    public function index()
    {
        return view('admin.g-stat')->withStat(GlobalStatisticController::get());
    }

    public function store(Request $request)
    {
        GlobalStatistics::where('name', 'users_count')
            ->update([
                'value' => $request->users_count,
            ]);

        GlobalStatistics::where('name', 'deposit')
            ->update([
                'value' => $request->deposit,
            ]);

        GlobalStatistics::where('name', 'profit')
            ->update([
                'value' => $request->profit,
            ]);

        GlobalStatistics::where('name', 'withdrawal')
            ->update([
                'value' => $request->withdrawal,
            ]);

        Log::channel('actionlog')->info('Пользователь ' . Auth::user()->email . ' изменил параметры глобальной статистики: ' . serialize($request->except('_token')));

        return back()->with('flash_success', "Данные обновлены.");
    }
}
