<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ResetEmailRequest extends FormRequest
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
            'email'              => 'required|unique:users',
            'email_confirmation' => 'same:email',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => trans('base_attention.email_reset_request.email_required'),
            'email.unique'   => trans('base_attention.email_reset_request.email_unique'),
            'email.same'     => trans('base_attention.email_reset_request.email_same'),
            'email.email'    => trans('base_attention.email_reset_request.email_email'),
        ];
    }
}
