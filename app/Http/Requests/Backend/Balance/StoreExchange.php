<?php

namespace App\Http\Requests\Backend\Balance;

use Illuminate\Foundation\Http\FormRequest;

class StoreExchange extends FormRequest
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
            'currency_from' => 'required',
            'currency_to'   => 'required',
            'amount_from'   => 'required',
            'amount_to'     => 'required',
            'rate'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'currency_from.required'    => __('base.dash.balance.exchange.required_currency_from'),
            'currency_to.required'      => __('base.dash.balance.exchange.required_currency_to'),
            'amount_from.required'      => __('base.dash.balance.exchange.required_amount_from'),
            'amount_to.required'        => __('base.dash.balance.exchange.required_amount_to'),
            'rate.required'             => __('base.dash.balance.exchange.required_rate'),
        ];
    }
}
