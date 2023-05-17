<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Home\Wallet;
use Illuminate\Http\Request;
use App\Http\ViewModels\Backend\WithdrawalFormViewModel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Home\Transaction;

class TransactionsService
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(/*User $user*/)
    {
        $viewModel = new WithdrawalFormViewModel(User::find(Auth::user()->id));

        return view('backend.pages.withdrawals', [
            'viewModel' => $viewModel,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request, Transaction $withdrawal)
    {
        dd($request->all(), $withdrawal);
        //$viewModel = new WithdrawalFormViewModel(User::find(Auth::user()->id), $withdrawal);
        //$wallet = Wallet::crea
/*проверяем кошелек - может, пользователь уже создавал такой же кошелек, если нет - создаем и
с id этго кошелька создаем транзакцию*/
        $withdrawal->update();

        return view('backend.pages.withdrawals', [
            'viewModel' => $viewModel,
        ]);
    }

}
