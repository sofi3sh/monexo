<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ReferralInvite\StoreReferralInvite;
use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\MarketingPlan;
use App\Models\Home\ReferralDeposit;
use App\Models\Home\Transaction;
use App\Models\Home\UserPaymentDetail;
use App\Models\InviteCommission;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteDepositMail;


class ReferralInviteController
{
    private string  $referralEmail;
    private int     $marketingPlanId;
    private float   $depositAmount;
    private int     $referralDepositId;
    private float   $commissionPercent;
    private float   $commissionAmount;
    private string  $packageName = '';

    private function createAlert()
    {
        $addInfoRu = 'Вы отправили инвайт на email: ' . $this->referralEmail;
        $addInfoEn = 'You have sent an invite to email ' . $this->referralEmail;

        /* if ( $this->depositAmount > 0 ) {
            $addInfoRu .= ' Был открыт депозит ' . $this->packageName . ' на сумму ' . $this->depositAmount;
            $addInfoRu .= '$ Комиссия: ' . $this->commissionPercent . '%  Сумма комиссии: ' . $this->commissionAmount . '$';

            $addInfoEn .= ' A deposit was opened ' . $this->packageName . ' for the amount ' . $this->depositAmount;
            $addInfoEn .= '$ Commission: ' . $this->commissionPercent . '%  Commission amount: ' . $this->commissionAmount . '$';
        } else {
            $addInfoRu .= ' Депозит для этого пользователя не открывался.';
            $addInfoEn .= ' The deposit for this user did not open.';
        } */

        Alert::insert([
            'user_id'           => Auth::user()->id,
            'email'             => Auth::user()->email,
            'amount'            => $this->depositAmount,
            'alert_id'          => AlertType::INVITE_REF_DEPOSIT,
            'add_info'          => json_encode([
                'ru' => $addInfoRu,
                'en' => $addInfoEn
            ]),
            'currency_type'     => 'usd',
            'marketing_plan_id' => null,
            'created_at'        => Carbon::now(),
        ]);
    }

    private function createReferralDeposit()
    {
        // Пользователя которого вы пытаетесь пригласить уже был приглашен ранее.
        if ( ReferralDeposit::on()->where('referral_email', $this->referralEmail)->count() > 0 ) {
            throw new Exception(__('referral_invite.message_error.already_sent_email'));
        }

        // Пользователь которого вы пытаетесь пригласить уже зарегистрирован.
        if ( User::on()->where('email', $this->referralEmail)->count() > 0 ) {
            throw new Exception(__('referral_invite.message_error.already_registered'));
        }

        $marketingPlanDescr = null;
        $marketingPlanId = null;
        $currency = null;

        // Если приглашаем пользователя с подарочным  пакетом.
        if ( $this->depositAmount > 0 ) {
            $marketingPlanId = $this->marketingPlanId;
            $marketingPlanDescr = MarketingPlan::find( $this->marketingPlanId )->name;
            $this->packageName = $marketingPlanDescr;
            $currency = 'USD';
        }

        ReferralDeposit::on()->insert([
            'user_id'               => Auth::user()->id,
            'amount_usd'            => $this->depositAmount,
            'commission_percent'    => $this->commissionPercent,
            'currency'              => $currency,
            'marketing_plan_id'     => $marketingPlanId,
            'marketing_plan_descr'  => $marketingPlanDescr,
            'is_accrued'            => 0, // 0 - не зачисленно реферралу, 1 - зачислено.
            'referral_email'        => $this->referralEmail,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        $this->referralDepositId = DB::getPdo()->lastInsertId();
    }

    private function sendEmail( $domain )
    {
        $content = [
            'link' => $domain . '/open-deposit-email/' . $this->referralDepositId,
            'fullName' => Auth()->user()->name . ' ' . Auth()->user()->surname,
        ];

        if ( $this->depositAmount > 0 ) {
            $content['packageName'] = $this->packageName;
            $content['packageAmount'] = $this->depositAmount;
        }

        Mail::to( $this->referralEmail )->send( new InviteDepositMail( $content ));
    }

    public function sendReferralInvite(StoreReferralInvite $request)
    {
        $this->referralEmail        = (string)  $request->get('invite-referral-email');
        $this->marketingPlanId      = (int)     $request->get('package');
        $this->depositAmount        = (float)   ( ! empty( $request->get('deposit-amount') ) ) ? $request->get('deposit-amount') : 0;
        $this->commissionPercent    = (float)   ( ! is_null( InviteCommission::getCommissions() ) ? InviteCommission::getCommissions() : 0 );
        $this->commissionAmount     = (float)   ( $this->depositAmount > 0 ) ? ( $this->depositAmount / 100 * $this->commissionPercent) : 0;
        $amountDeductedFromBalance  = (float)   ( $this->depositAmount > 0 )
                                                    ? $this->depositAmount + $this->commissionAmount
                                                    : 0;
        $currentUser                 = Auth::user();
        $currentBalanceUser          = (float)   $currentUser->balance_usd;

        if ( $currentBalanceUser < $amountDeductedFromBalance ) {
            return redirect()
                ->back()
                ->withErrors(__('referral_invite.message_error.no_cash'));
        }

        try {
            DB::beginTransaction();

            $this->createReferralDeposit();
            $this->createAlert();

            /* if ( $this->depositAmount > 0 ) {
                $currentUser->update([
                    'balance_usd' => $currentBalanceUser - $amountDeductedFromBalance, // Снять деньги со счёта
                    'updated_at' => Carbon::now(),
                ]);
            }

            Transaction::insert([
                'user_id'                       => $currentUser->id,
                'transaction_type_id'           => TransactionsTypesConsts::INVITE_REF_DEPOSIT,
                'amount_usd'                    => $this->depositAmount,
                'balance_usd_after_transaction' => ($currentBalanceUser - $amountDeductedFromBalance),
                'commission'                    => $this->commissionAmount,
                'created_at'                    => Carbon::now(),
                'updated_at'                    => Carbon::now(),
            ]); */

            DB::commit();
            $this->sendEmail($request->root());
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }

        $success        = __('referral_invite.message_success.success');
        $email          = __('referral_invite.message_success.email') . $this->referralEmail;
        $package        = __('referral_invite.message_success.package') . $this->packageName;
        $depositAmount  = __('referral_invite.message_success.deposit_amount') . $this->depositAmount . ' USD';

        return redirect()
            ->back()
            ->with(compact('success', 'email', 'package', 'depositAmount'));
    }
}
