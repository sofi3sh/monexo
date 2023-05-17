<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class StoreTransferBetweenAccount extends FormRequest
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
                'required|numeric|lte:' . User::find($this->from_user_id)->firstOrFail()->balance_usd,
            'to_email'   =>
                'exists:users,email',
        ];
    }

    public function messages()
    {
        return [
            'amount_usd.required' => 'Введите сумму.',
            'amount_usd.lte'      => 'Введенная сумма превышает баланс.',
            'to_email.exists'     => 'Введенный email не найден в базе.',
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
