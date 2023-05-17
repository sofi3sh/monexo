<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Consts\WalletsTypesConsts;
use App\Models\Home\Wallet;
use Illuminate\Http\Request;
use App\Http\ViewModels\Backend\TransactionsFormViewModel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Home\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\Home\UserMarketingPlan;
use App\Models\Home\UserPaymentDetail;

class TransactionsPageController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $viewModel = new TransactionsFormViewModel();
//        return view('backend.pages.transactions', [
//            'marketingPlans' => Auth::user()->userAllMarketingPlans(),
//            'viewModel'      => $viewModel,
//        ]);
        $payments = UserPaymentDetail::where('user_id',Auth::user()->id)->OrderByDesc('id')->limit(10)->get();
        return view('dashboard.history',compact('payments'));
    }
}

