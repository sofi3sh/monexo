<?php

namespace App\Observers;

use App\Models\Consts\BalanceTypeConstants;
use App\Models\Consts\CurrencyConstants;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Transaction;
use App\Models\Home\UserWallet;
use Illuminate\Support\Facades\Auth;
use Exception;

class TransactionObserver
{
    /**
     * Handle the transaction "created" event.
     *
     * @param  \App\Transaction $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        // Определяем пользователя по которому создается транзакция
        $user = $transaction->user()->first();
        $amount_usd = $transaction->amount_usd;
        $amount_btc = $transaction->amount_btc;
        $amount_eth = $transaction->amount_eth;
        $amount_pzm = $transaction->amount_pzm;
        // Для:
        //  * инвестиций;
        //  * перевода прибыли с маркетингового плана на основной счет.
        //  * покупки маркетинг-плана
        if (
            $this->isInvestTransaction($transaction)
            /* || $this->isTransferBdyFromMarketingPlanToMainBalance($transaction) */
            || $this->isInvestToMarketingPlanFromMainBalanceTransaction($transaction)
            || $this->isBonusesTransaction($transaction)) {
            $user->balance_usd += $amount_usd;
            $user->balance_btc += $amount_btc;
            $user->balance_eth += $amount_eth;
            $user->balance_pzm += $amount_pzm;
        };
        // Для ввода средств увеличиваем общую инвестированную сумму


        // Если транзакция - прибыль от маркетинг-плана или за рефералов
        if ($this->isTransactionProfitFromMarketingPlan($transaction) || $this->isTransactionProfitFromReferrals($transaction)) {
            $user->balance_usd += $amount_usd;
            $user->balance_btc += $amount_btc;
            $user->balance_eth += $amount_eth;
            $user->balance_pzm += $amount_pzm;
//            $user->profit_usd += $amount_usd;
        }

        // Если созданная транзакция - прибыль от линии рефералов, пересчитываем общую сумму у пользователя, полученную от прибыли рефералов
        if ($this->isTransactionProfitFromReferrals($transaction)) {
            $user->referrals_usd += $amount_usd;
        }

        // Если созданная транзакция - заявка на вывод
        if ($this->isRequestWithdrawalTransaction($transaction)) {
            $user->balance_usd += $amount_usd; // "+" - поскольку заявка с "-"
            $user->balance_btc += $amount_btc; // "+" - поскольку заявка с "-"
            $user->balance_eth += $amount_eth; // "+" - поскольку заявка с "-"
            $user->balance_pzm += $amount_pzm; // "+" - поскольку заявка с "-"
            $user->withdrawal_request_usd += $amount_usd;
        }

        // Если созданная транзакция - вывод /сразу, минуя создание заявки/ (может быть создана фейковая для пользователя через админку)
        if ($this->isWithdrawalTransaction($transaction)) {
            // Меняем знак, поскольку при ручном создании транзы, сумма идет с "-"
            $user->withdrawal_usd += -$amount_usd;
        }

        // Если созданная транзакция "Инвестирование в маркетинг-план с баланса коина"
        if ($this->isInvestToMarketingPlanFromCoinBalanceTransaction($transaction)) {
            // Уменьшаем баланс коина у пользователя
            $balance = $user->balance(
                BalanceTypeConstants::INVEST_TO_COIN,
                CurrencyConstants::USD
            )->first();
            $balance->balance += $amount_usd;
            $balance->save();
        }

        switch ($transaction->transaction_type_id) {
            case TransactionsTypesConsts::GRAYBULL_BET_OPENING:
                if ($transaction->amount_usd) $user->decrement('balance_usd', $transaction->amount_usd);
                if ($transaction->amount_btc) $user->decrement('balance_btc', $transaction->amount_btc);
                if ($transaction->amount_eth) $user->decrement('balance_eth', $transaction->amount_eth);
                if ($transaction->amount_pzm) $user->decrement('balance_pzm', $transaction->amount_pzm);

                break;
            case TransactionsTypesConsts::GRAYBULL_REFERRAL_BONUS:
            case TransactionsTypesConsts::GRAYBULL_PAYMENT:
            case TransactionsTypesConsts::USER_STATUS_REGIONAL_REPRESENTATIVE_REJECTED:
                $user->increment('balance_usd', $transaction->amount_usd);

                break;
            case TransactionsTypesConsts::LEADERSHIP_BONUS:
                $user->increment('balance_usd', $transaction->amount_usd);
                $user->increment('bonuses_usd', $transaction->amount_usd);

                break;
            case TransactionsTypesConsts::USER_STATUS_REGIONAL_REPRESENTATIVE:
                $user->decrement('balance_usd', $transaction->amount_usd);

                break;
            case TransactionsTypesConsts::SYSTEM:
                $user->balance_usd += $amount_usd;
                $user->balance_btc += $amount_btc;
                $user->balance_eth += $amount_eth;
                $user->balance_pzm += $amount_pzm;
                break;
        }

        if ( $transaction->transaction_type_id === TransactionsTypesConsts::BUY_SERVICES ||
            $transaction->transaction_type_id === TransactionsTypesConsts::SERVICES_REFERRAL_BONUS
        ) {
            if ($transaction->amount_usd) {
                $user->decrement('balance_usd', $transaction->amount_usd);
            }
        }

        if ( $transaction->transaction_type_id === TransactionsTypesConsts::EXCHANGE ) {
            $currencyFrom = substr($transaction->exchange_direction, 0, 3); // pzm
            $currencyTo = substr($transaction->exchange_direction, 4, 3); // usd


            $fieldAmountCurrencyFrom = 'amount_' . $currencyFrom;
            $fieldAmountCurrencyTo = 'amount_' . $currencyTo;

//            throw new Exception($fieldAmountCurrencyFrom . ' = ' . $fieldAmountCurrencyTo);

            $user->decrement('balance_' . $currencyFrom, $transaction->$fieldAmountCurrencyFrom);
            $user->increment('balance_' . $currencyTo, $transaction->$fieldAmountCurrencyTo);
        }

        $user->save();
    }

    /**
     * Handle the transaction "deleted" event.
     *
     * @param  \App\Transaction $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //todo-tk Обработка события удаления транзакции начисления по маркетинг-плану

        // Определяем пользователя по которому создается транзакция
        $user = $transaction->user()->first();
        //
        $amount_usd = $transaction->amount_usd;
        $profit_usd = 0;
        $referrals_usd = 0;
        $invested_usd = 0;
        $withdrawal_request_usd = 0;
        $withdrawal_usd = 0;

        // Для всех транзакций, кроме начисления прибыли по депозиту на криптокошелек уменьшаем баланс на величину созданной транзакции
        if (!$this->isDepositProfitInCrypto($transaction)) {
            $user->balance_usd -= $amount_usd;
        }

        // Если удаляем транзакцию инвестирования - меняется сумма инвестирования и баланс


        // Если удаляем транзакцию дохода по маркетинговому плану - меняется сумма, заработанная от депозита и баланс
        if ($this->isTransactionProfitFromMarketingPlan($transaction)) {
            $profit_usd = $transaction->amount_usd;
        }

        // Если удаляем транзакцию дохода от рефералов - меняется сумма, заработанная на рефералах и баланс
        if ($this->isTransactionProfitFromReferrals($transaction)) {
            $referrals_usd = $transaction->amount_usd;
        }

        // Если удаляем завявку на вывод
        if ($this->isRequestWithdrawalTransaction($transaction)) {
            $withdrawal_request_usd = $transaction->amount_usd;
            $user->balance_btc -= $transaction->amount_btc;
            $user->balance_eth -= $transaction->amount_eth;
            $user->balance_pzm -= $transaction->amount_pzm;
        }

        // Если удаляем транзакцию вывода - меняется общая выведенная сумма
        if ($this->isWithdrawalTransaction($transaction)) {
            $withdrawal_usd = -$transaction->amount_usd;
        }

        // Если удаляем транзакцию "Прибыль по депозиту в криптовалюте" - уменьшаем баланс криптокошелька
        if ($this->isDepositProfitInCrypto($transaction)) {
            $user_wallet = UserWallet::find($transaction->related_user_wallet_id);
            $user_wallet->amount -= $transaction->amount_crypto;
            $user_wallet->save();
        }

        // Если удаляем транзакцию "Перевод криптокошельков" - todo Закончить
        if ($this->isTransferCryptoWallets($transaction)) {

        }

        $user->invested_usd -= $invested_usd;

        $user->profit_usd -= $profit_usd;

        $user->referrals_usd -= $referrals_usd;

        $user->withdrawal_usd -= $withdrawal_usd;

        $user->withdrawal_request_usd -= $withdrawal_request_usd;
        $user->editor_id = Auth::user()->id;
        $user->save();
    }

    /**
     * Возвращает true, если транзакция - "Перевод тела с маркетинг-плана на основной счет", иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isTransferBdyFromMarketingPlanToMainBalance(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::TRANSFER_BODY_FROM_MARKETING_PLAN_TO_MAIN_BALANCE;
    }

    /**
     * Возвращает true, если транзакция - вывод, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isWithdrawalTransaction(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::WITHDRAWAL_TYPE_ID;
    }

    /**
     * Возвращает true, если транзакция - заявка на вывод, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isRequestWithdrawalTransaction(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID;
    }

    /**
     * Возвращает True, если транзакция - прибыль от маркетингового плана, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isTransactionProfitFromMarketingPlan(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id === TransactionsTypesConsts::PROFIT_TYPE_ID;
    }

    /**
     * Возвращает True, если транзакция - прибыль от рефералов, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isTransactionProfitFromReferrals(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM;
    }

    /**
     * Возвращает True, если транзакция - инвестиция или перевод между аккаунтами, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isInvestTransaction(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::INVEST_TYPE_ID;
    }

    /**
     * Возвращает True, если транзакция - бонусы, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isBonusesTransaction(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::BONUSES_TYPE_ID;
    }

    /**
     * Возвращает True, если транзакция - начисление прибыли по депозиту на криптокошелек, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isDepositProfitInCrypto(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::DEPOSIT_PROFIT_IN_CRYPTO_TYPE_ID;
    }

    /**
     * Возвращает True, если транзакция "Перевод криптокошельков", иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isTransferCryptoWallets(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::TRANSFER_CRYPTO_WALLETS_TYPE_ID;
    }

    /**
     * Возвращает True, если транзакция "Инвестиция в маркетинг-план с баланса коина", иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isInvestToMarketingPlanFromCoinBalanceTransaction(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_COIN_BALANCE;
    }

    /**
     * Возвращает True, если транзакция "Инвестиция в маркетинг-план с основного баланса", иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isInvestToMarketingPlanFromMainBalanceTransaction(Transaction $transaction): bool
    {
        return $transaction->transaction_type_id == TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE;
    }


    /**
     * Handle the transaction "updated" event.
     *
     * @param  \App\Transaction $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        // Если тип транзакции изменился с "Заявка на вывод" на "Вывод"
        if ($this->isConfirmWithdrawal($transaction)) {
            // Изменяем балансы пользователя
            $user = $transaction->user()->first();
            $user->withdrawal_request_usd -= $transaction->amount_usd; // Поскольку сумма отрицательная - выполняется сложение
            $user->withdrawal_usd += -$transaction->amount_usd;
            $user->save();
        }
    }

    /**
     * Если тип транзакции до обновления "Запрос на вывод" и новое значение "Вывод", возвращает True, иначе - False.
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isConfirmWithdrawal(Transaction $transaction): bool
    {
        return (($transaction->getOriginal()['transaction_type_id'] == TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID) &&
            ($transaction->transaction_type_id == TransactionsTypesConsts::WITHDRAWAL_TYPE_ID));
    }

    /**
     * Возвращает True, если обновление - это удаление заявки на вывод
     *
     * @param Transaction $transaction
     * @return bool
     */
    public function isDeleteWithdrawalRequest(Transaction $transaction): bool
    {
        return ($transaction->transaction_type_id == TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID) &&
            (!is_null($transaction->deleted_at));
    }

    /**
     * Handle the transaction "restored" event.
     *
     * @param  \App\Transaction $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "force deleted" event.
     *
     * @param  \App\Transaction $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
