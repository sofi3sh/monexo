<?php

namespace Modules\Graybull\Services;

use App\Models\User;
use App\Models\Home\{Transaction, Alert};
use App\Models\Consts\{TransactionsTypesConsts, AlertType};
use Modules\Graybull\Models\Bet;
use Modules\Graybull\Models\BetPayment;

class UserService
{
    /**
     * Совершить выплату пользователю
     *
     * @param User $user
     * @param BetPayment $payment
     */
    public static function payUser(User $user, BetPayment $payment): void
    {
        Transaction::create([
            'user_id' => $user->id,
            'transaction_type_id' => TransactionsTypesConsts::GRAYBULL_PAYMENT,
            'amount_usd' => $payment->amount_usd,
            'balance_usd_after_transaction' => $user->balance_usd + $payment->amount_usd,
        ]);

        Alert::create([
            'user_id' => $user->id,
            'alert_id' => AlertType::GRAYBULL_PAYMENT,
            'amount' => $payment->amount_usd,
        ]);
    }

    /**
     * Списание средств с баланса пользователя за открытие ставки
     *
     * @param User $user
     * @param string $balance
     * @param float $amount
     */
    public static function debitingUserFunds(User $user, string $balance, float $amount): void
    {
        Transaction::create(
            [
                'user_id' => $user->id,
                'transaction_type_id' => TransactionsTypesConsts::GRAYBULL_BET_OPENING,
                "amount_{$balance}" => $amount,
                "balance_{$balance}_after_transaction" => $user->{"balance_{$balance}"} - $amount,
            ]
        );

        Alert::create([
            'user_id' => $user->id,
            'alert_id' => AlertType::GRAYBULL_BET_OPENING,
            'amount' => $amount,
            'currency_type' => $balance,
        ]);

        if ($user->ancestor) {
            self::rewardUserAncestor($user, $user->ancestor);
        }
    }

    /**
     * Награждение предка пользователя за открытие ставки пользователем
     *
     * @param User $user
     * @param User $userAncestor
     */
    private static function rewardUserAncestor(User $user, User $userAncestor): void
    {
        Transaction::create(
            [
                'user_id' => $userAncestor->id,
                'related_user_id' => $user->id,
                'transaction_type_id' => TransactionsTypesConsts::GRAYBULL_REFERRAL_BONUS,
                'amount_usd' => Bet::REFERRAL_REWARD,
                'balance_usd_after_transaction' => $userAncestor->balance_usd + Bet::REFERRAL_REWARD,
            ]
        );

        Alert::create([
            'user_id' => $userAncestor->id,
            'alert_id' => AlertType::GRAYBULL_REFERRAL_BONUS,
            'amount' => Bet::REFERRAL_REWARD,
        ]);
    }
}
