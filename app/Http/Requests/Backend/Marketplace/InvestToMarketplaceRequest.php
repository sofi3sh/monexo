<?php

namespace App\Http\Requests\Backend\Marketplace;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InvestToMarketplaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::guest();
    }

    public function rules()
    {
        return [
            'sum' => 'required|numeric|min:1|max:' . Auth::user()->balance_usd,
        ];
    }

    public function messages()
    {
        return [
            'sum.max' => 'Введенная сумма превышает баланс.',
        ];
    }
}
