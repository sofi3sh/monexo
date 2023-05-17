<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WithdrawalLimit;
use App\Models\WithdrawCommissionSettings;
use DB;

class WithdrawalRegulationsController extends Controller
{

    public function index()
    {
        $commission = WithdrawCommissionSettings::getCommissions();
        $withdrawalLimits = WithdrawalLimit::all();

        return view('admin.withdrawal-regulations.index', compact('commission', 'withdrawalLimits'));
    }
    
    public function editCommissions()
    {
        $commission = WithdrawCommissionSettings::getCommissions();

        return view('admin.withdrawal-regulations.edit-commissions', compact('commission'));
    }

    
    public function updateCommissions(Request $request)
    {
        $data = $request->validate([
            'period-7' => 'required',
            'period-14' => 'required',
            'period-30' => 'required',
            'period-0' => 'required',
        ]);

        $peiod7 = WithdrawCommissionSettings::find(WithdrawCommissionSettings::DAYS_7);
        $peiod14 = WithdrawCommissionSettings::find(WithdrawCommissionSettings::DAYS_14);
        $peiod30 = WithdrawCommissionSettings::find(WithdrawCommissionSettings::DAYS_30);
        $peiod0 = WithdrawCommissionSettings::find(WithdrawCommissionSettings::DAYS_0);

        DB::beginTransaction();
        try {
            $peiod7->commission = $data['period-7'];
            $peiod14->commission = $data['period-14'];
            $peiod30->commission = $data['period-30'];
            $peiod0->commission = $data['period-0'];

            foreach([$peiod7, $peiod14, $peiod30, $peiod0] as $period) {
                $period->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        return redirect()->route('admin.withdrawal-regulations.index');
    }

    public function editLimits()
    {
        $limits = WithdrawalLimit::select('id', 'name', 'value')->get();

        return view('admin.withdrawal-regulations.edit-limits', [
            'limits' => $limits,
            'title' => 'Настройка ограничений вывода', 
            'action_route' => route('admin.withdrawal-regulations.limits.update'), 
        ]);
    }

    public function updateLimits(Request $request)
    {
        $id = $request->input('id');
        $value = $request->input('value');
        
        $limit = WithdrawalLimit::find($id);
        $limit->value = $value;
        $limit->save();
        
        return redirect()->route('admin.withdrawal-regulations.index');
    }
}
