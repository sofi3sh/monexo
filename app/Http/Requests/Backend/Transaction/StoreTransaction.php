<?php

namespace App\Http\Requests\Backend\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaction extends FormRequest
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
            'amount_usd' =>
                'required|numeric' .
                '|gte:' . (is_null(Auth()->user()->motivation_plan_id) ? config('finance.minimum_withdrawal_amount') : Auth()->user()->motivationPlan->min_withdrawal) .
                '|lte:' . Auth()->user()->getAmountAvailableWithdrawal(),
            'address'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount_usd.required' => 'Введите сумму.',
            'amount_usd.gte'      => 'Минимальная сумма для вывода: $' . is_null(Auth()->user()->motivation_plan_id) ? config('finance.minimum_withdrawal_amount') : Auth()->user()->motivationPlan->min_withdrawal . '.',
            'amount_usd.lte'      => 'Сумма превышает допустимую для вывода.',
            'address.required'    => 'Введите адрес кошелька.',
        ];
    }

    //todo Не работает - все сообщения прописываю в messages()

    /**
     * Возвращает названия атрибутов.
     *
     * @return array
     */
    public function attribute()
    {
        return [
            'amount_usd' => 'Сумма',
        ];
    }
}
