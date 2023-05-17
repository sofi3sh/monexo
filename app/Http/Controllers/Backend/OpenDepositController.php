<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Pages\MarketingPlanController;
use App\Models\Home\MarketingPlan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\ReferralDeposit;
use Illuminate\Support\Facades\Log;

class OpenDepositController extends Controller
{
    public function openDepositFromEmail($id)
    {
        $referralDepositId = $id;
        return redirect()->route('register', ['referral_deposit_id' => $referralDepositId]);
    }
}
