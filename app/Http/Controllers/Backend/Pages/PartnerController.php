<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Models\{User, UserStatus, UserStatusRequest};
use App\Models\Home\{Transaction, Alert, UserMarketingPlan};
use App\Models\Consts\{TransactionsTypesConsts, AlertType};
use App\Http\Controllers\Controller;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Mail};

class PartnerController extends Controller
{
    public function createRegionalRepresentativeRequest(Request $request)
    {
        $requestData = $request->validate([
            'region' => 'required|string|min:2|max:191',
            'social_networks' => 'required|min:1',
            'social_networks.*' => 'string|in:instagram,telegram',
            'comment' => 'nullable|string|max:300',
        ]);

        $statusPriceInUsd = 0;

        if (in_array('telegram', $requestData['social_networks'], true)) {
            $statusPriceInUsd += UserStatusRequest::REGIONAL_REPRESENTATIVE_STATUS_TELEGRAM_PRICE;
        }

        if (in_array('instagram', $requestData['social_networks'], true)) {
            $statusPriceInUsd += UserStatusRequest::REGIONAL_REPRESENTATIVE_STATUS_INSTAGRAM_PRICE;
        }

        /** @var User $authUser */
        $authUser = auth()->user();

        if ($authUser->balance_usd < $statusPriceInUsd) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'price' => __('Insufficient funds'),
                ]);
        }

        $userStatusRequest = null;

        DB::transaction(function () use (&$userStatusRequest, $requestData, $authUser, $statusPriceInUsd) {
            $userStatusRequest = UserStatusRequest::query()->updateOrCreate([
                'user_id' => $authUser->id,
                'user_status_id' => UserStatus::STATUS_REGIONAL_REPRESENTATIVE,
                'request_status' => UserStatusRequest::STATUS_WAIT,
            ], [
                'user_status_id' => UserStatus::STATUS_REGIONAL_REPRESENTATIVE,
                'extra_data' => [
                    'region' => $requestData['region'],
                    'social_networks' => $requestData['social_networks'],
                    'comment' => $requestData['comment'],
                    'price' => $statusPriceInUsd,
                ],
            ]);

            if ($userStatusRequest->wasRecentlyCreated) {
                Transaction::create([
                    'user_id' => $authUser->id,
                    'transaction_type_id' => TransactionsTypesConsts::USER_STATUS_REGIONAL_REPRESENTATIVE,
                    'amount_usd' => $statusPriceInUsd,
                    'balance_usd_after_transaction' => $authUser->balance_usd - $statusPriceInUsd,
                ]);

                Alert::create([
                    'user_id' => $authUser->id,
                    'alert_id' => AlertType::USER_STATUS_REGIONAL_REPRESENTATIVE,
                    'amount' => $statusPriceInUsd,
                    'currency_type' => 'usd',
                ]);
            }
        });

        $status = $userStatusRequest->wasRecentlyCreated
            ? __('Request successfully created')
            : __('Request successfully updated');

        return redirect()->back()->with([
            'status' => $status,
            'region' => $userStatusRequest->extra_data['region'],
            'social_networks' => $userStatusRequest->extra_data['social_networks'],
            'comment' => $userStatusRequest->extra_data['comment'] ?? null,
        ]);
    }

    public function createInvitationDeposit(Request $request)
    {
        $requestData = $request->validate([
            'email' => 'required|email',
        ]);

        /** @var User $sender */
        $sender = auth()->user();

        /** @var User $recipient */
        $recipient = User::where('email', $requestData['email'])->first();

        if (!$recipient) {
            Mail::to($requestData['email'])
                ->send(new InvitationMail($sender));

            return redirect()->back()->with([
                'status' => __('Invitation letter was sent to mail') . ' ' . $requestData['email'],
            ]);
        }

        $checkIsUserAlreadyHasInvitationDeposit = function () use ($recipient): bool {
            return UserMarketingPlan::where('user_id', $recipient->id)->exists();
        };

        if ($recipient->parent_id !== $sender->id || $checkIsUserAlreadyHasInvitationDeposit()) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'email' => __('Can\'t send invitation deposit to selected user'),
                ]);
        }

        UserMarketingPlan::addInvitationMarketingPlan($recipient);

        return redirect()->back()->with([
            'status' => __('Invitation deposit was successfully sent to user') . ' ' . $recipient->name,
        ]);
    }
}
