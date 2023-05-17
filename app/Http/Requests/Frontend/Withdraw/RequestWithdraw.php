<?php

namespace App\Http\Requests\Frontend\Withdraw;

use Illuminate\Foundation\Http\FormRequest;

class RequestWithdraw extends FormRequest
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
            'card_name' => 'sometimes|required',
            //'card_patronymic' => 'sometimes|required',
            'card_surname' => 'sometimes|required',
            'card_phone' => 'sometimes|required',
            //'card_number' => 'sometimes|required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
