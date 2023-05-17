<?php

namespace App\Http\ViewModels\Backend;

use App\Models\Home\Transaction;
use App\Models\Home\Currency;
use App\Models\User;
use Illuminate\Support\Collection;
use App\Models\Consts\TransactionsTypesConsts;

class TransactionsFormViewModel
{
    private $withdrawal;
    public $transaction_type_id;

    /**
     * WithdrawalFormViewModel constructor.
     *
     * @param User $user
     * @param Transaction|null $withdrawal
     */
    public function __construct(/*User $user*/)
    {
        //$this->user = $user;
    }

    /**
     *
     *
     * @param $transaction_type_id
     * @return mixed
     */
    public function getTransactions($transaction_type_id = null)
    {
        // Если не передан id типа транзакции - возвращаем все
        if (is_null($transaction_type_id)) {
            $tr = Transaction::with('transactionType', 'wallet', 'wallet.currency')
                ->where('user_id', Auth()->user()->id);
            $transactions = $tr->orderBy('updated_at', 'desc')->get();
        } else {
            if (is_array($transaction_type_id)) {
                $tr = Transaction::with('transactionType', 'wallet', 'wallet.currency')
                    ->whereIn('transaction_type_id', $transaction_type_id)
                    ->where('user_id', Auth()->user()->id);
                $transactions = $tr->orderBy('updated_at', 'desc')->get();
            } else {
                $tr = Transaction::with('transactionType', 'wallet', 'wallet.currency')
                    ->where('transaction_type_id', $transaction_type_id)
                    ->where('user_id', Auth()->user()->id);
                $transactions = $tr->orderBy('updated_at', 'desc')->get();
            }
        }

        $sum = $tr->sum('amount_usd');

        return [$sum, $transactions];
    }

}