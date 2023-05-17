<?php

namespace App\Http\Requests\Backend\MarketingPlan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Rules\Marketing\IsMinRequiredInvestSumToMarketingPlan;
use App\Rules\Marketing\IsMaxRequiredInvestSumToMarketingPlan;
use App\Rules\Marketing\IsNoActiveMarketingPlan;
use App\Rules\Marketing\IsBalanceMoreThenInvestedSum;
use Illuminate\Support\Facades\Auth;

class InvestToMarketingPlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'invested_usd' => [
                'required',
                'numeric',
                new IsMinRequiredInvestSumToMarketingPlan(Auth::user(), $request->marketing_plan_id, $request->invested_usd),
                new IsMaxRequiredInvestSumToMarketingPlan(Auth::user(), $request->marketing_plan_id, $request->invested_usd),
                new IsBalanceMoreThenInvestedSum($request->invested_usd),
            ],
        ];
    }

    /**
     * Form Request Error Messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'invested_usd.min' => trans('base_attention.invest_to_marketing.wrong_sum'),
        ];
    }
}
