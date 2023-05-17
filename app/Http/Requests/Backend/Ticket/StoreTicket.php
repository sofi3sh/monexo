<?php

namespace App\Http\Requests\Backend\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicket extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'theme' => 'required',
            'appeal_id' => 'required',
            'question' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'theme.required' => __('ticket.store.theme'),
            'appeal_id.required' => __('ticket.store.appeal_id'),
            'question.required' => __('ticket.store.question'),
        ];
    }
}
