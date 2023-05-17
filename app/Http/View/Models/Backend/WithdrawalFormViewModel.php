<?php

namespace App\Http\ViewModels\Backend;

use App\Models\Home\Transaction;
use App\Models\Home\Currency;
use App\Models\User;
use Illuminate\Support\Collection;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Rate;
use Illuminate\Support\Facades\Auth;

class WithdrawalFormViewModel
{
    private $withdrawal;
    public $withdrawals;
    public $transaction_type_id;
    public $withdrawal_requests;
    public $available_for_withdrawal;
    public $rates;

    /**
     * WithdrawalFormViewModel constructor.
     *
     * @param User $user
     * @param Transaction|null $withdrawal
     */
    public function __construct(
        User $user,
        Transaction $withdrawal = null
    )
    {
        $this->user = $user;
        $this->withdrawal = $withdrawal;

        $this->withdrawal_requests = User::getTransactions(TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID);
        $this->withdrawal_requests->load('wallet', 'wallet.currency');
        $this->transaction_type_id = TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID;
        $this->available_for_withdrawal = $user->getAmountAvailableWithdrawal();

        $rates = Rate::all();
        $rates->load('currency');
        $rates_array = [];
        foreach ($rates as $rate) {
            $rates_array[$rate->currency->code] = $rate->rate;
        }
        $this->rates = json_encode($rates_array);

        $whithdrawals = Transaction::where('user_id', Auth::user()->id)->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)->get()->sortBy('id');
        $whithdrawals->load('wallet');
        $this->withdrawals = $whithdrawals;
    }

    /**
     * Если в конструктор была передана транзакция - возвращает ее, иначе - создает новую.
     *
     * @return Transaction
     */
    public function withdrawal(): Transaction
    {
        return $this->withdrawal ?? new Transaction();
    }

    /**
     * Возвращает коллекцию криптовалют на которые можно выполнять вывод средств.
     *
     * @return Collection
     */
    public function currencies(): Collection
    {
        return Currency::allowedForWithdrawalCurrencies();
    }

    /**
     * Возвращает коллекцию плат. систем на которые можно выполнять вывод средств.
     *
     * @return Collection
     */
    public function paymentSystems(): Collection
    {
        return Currency::getAllowedForWithdrawalPaymentSystems();
    }

}