<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
            // 'current'               => 'required',
            'password'              => 'required|min:8',
            'password_confirmation' => 'same:password'
        ];
    }

    public function messages()
    {
        return [
            // 'password.required' => 'Укажите текущий пароль.',
            'password.required'          => 'Задайте новый пароль.',
            'password.min'               => 'Минимальная длина пароля — 8 символов.',
            'password_confirmation.same' => 'Введенные пароли не совпадают.',
        ];
    }
}
