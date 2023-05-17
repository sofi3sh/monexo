<?php

namespace App\Http\Requests\Backend\ReferralInvite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

class StoreReferralInvite extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $balanceUSDUser = Auth::user()->balance_usd;
        switch ( Request::get('package') ) {
            case '24': // Light
                $min = 1000;
                $max = 10000;
                break;
            case '26': // Mini
                $min = 100;
                $max = 2000;
                break;
            default:
                $min = 0;
                $max = 0;
        }

        return [
            'invite-referral-email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'package' => [
                Rule::in(['24', '26']),
            ],
            'deposit-amount' => "numeric|between:$min,$max|max:$balanceUSDUser",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'invite-referral-email.required'    => __('referral_invite.letter.invite-referral-email_required'),
            'invite-referral-email.email'       => __('referral_invite.letter.invite-referral-email_email'),
            'invite-referral-email.unique'      => __('referral_invite.letter.invite-referral-email_unique'),
//            'package.required'                  => __('referral_invite.letter.package_required'),
//            'package.in'                        => __('referral_invite.letter.package_in'),
//            'deposit-amount.required'           => __('referral_invite.letter.deposit-amount_required'),
//            'deposit-amount.numeric'            => __('referral_invite.letter.deposit-amount_numeric'),
//            'deposit-amount.digits_between'     => __('referral_invite.letter.deposit-amount_digits_between'),
//            'deposit-amount.max'                => __('referral_invite.letter.deposit-amount_max'),
        ];
    }
}
