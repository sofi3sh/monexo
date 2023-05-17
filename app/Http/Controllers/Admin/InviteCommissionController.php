<?php

namespace App\Http\Controllers\Admin;

use App\Models\InviteCommission;
use App\Models\WithdrawCommissionSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InviteCommissionController extends Controller
{
    public function index()
    {
        $commission = InviteCommission::getCommissions();

        return view('admin.inviteCommission.index', compact('commission'));
    }

    public function edit()
    {
        $id = InviteCommission::getId();
        $commission = InviteCommission::getCommissions();

        return view('admin.inviteCommission.edit', compact('id', 'commission'));
    }

    public function update(Request $request)
    {
        try {
            InviteCommission::on()->updateOrCreate(['id' => $request->id], [
                'commission' => $request->commission,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->route('admin.invite-commission.index');
    }
}
