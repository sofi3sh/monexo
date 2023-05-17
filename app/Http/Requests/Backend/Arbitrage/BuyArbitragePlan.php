<?php

namespace App\Http\Requests\Backend\Arbitrage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BuyArbitragePlan extends FormRequest
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
            'price' => 'required|numeric|max:' . Auth::user()->balance_usd,
        ];
    }

    public function messages()
    {
        return [
            'price.max' => 'Недостаточно средств для приобретения выбранного плана.',
        ];
    }

}
