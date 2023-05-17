<?php

namespace App\Http\Requests\Backend\Arbitrage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateArbitrage extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            // Максимальная сумма ставки не должна превышать ограничение для текущего плана и баланс, должна быть больше нуля
            'amount_usd' => 'required|numeric|not_in:0|max:' . min([Auth::user()->arbitrageTradingPlan()->first()->max_sum, Auth::user()->balance_usd]),
        ];
    }

    public function messages()
    {
        return [
            'amount_usd.not_in' => 'Сумма ставки должна быть больше нуля.',
            'amount_usd.max' => 'Введенная сумма превышает максимальную для текущего плана или Ваш баланс.',
        ];
    }
}
