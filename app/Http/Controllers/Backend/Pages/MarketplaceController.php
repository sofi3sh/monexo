<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Transaction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Marketplace\InvestToMarketplaceRequest;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    /**
     * Отображение страницы инвестирования в маркетплейс
     *
     * @return mixed
     */
    public function index()
    {
        $invests = Transaction::where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETPLACE_TYPE_ID)
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('backend.pages.marketplace.index')
            ->with([
                'invests'                       => $invests,
                'total_invested_to_marketplace' => Auth::user()->investedToMarketplace()
            ]);
    }

    /**
     * Выполнение инвестиции в маркетплейс
     *
     * @param InvestToMarketplaceRequest $request
     * @return mixed
     */
    public function invest(InvestToMarketplaceRequest $request, Transaction $transaction)
    {
        $this->createInvestTransaction($transaction, Auth::user(), $request->sum);

        return back()->with('flash_success', 'Инвестиция успешно выполнена.');
    }

    public function createInvestTransaction(Transaction $transaction, Authenticatable $user, float $sum)
    {
        $transaction->user_id = $user->id;
        $transaction->transaction_type_id = TransactionsTypesConsts::INVEST_TO_MARKETPLACE_TYPE_ID;
        $transaction->balance_usd_after_transaction = $user->balance_usd - $sum;
        $transaction->amount_usd = -$sum;
        $transaction->save();
    }
}
