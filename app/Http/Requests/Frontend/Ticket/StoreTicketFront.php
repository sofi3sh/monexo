<?php

namespace App\Http\Requests\Frontend\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class StoreTicketFront extends FormRequest
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
            'ticket_full_name' => 'required',
            'ticket_email'     => 'required|email',
            'ticket_phone'     => 'required',
            'ticket_question'  => 'required',
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
            'full_name.required'    => __('ticket.validation.full_name_required'),
            'email.required'        => __('ticket.validation.email_required'),
            'email.email'           => __('ticket.validation.email_email'),
            'phone.required'        => __('ticket.validation.phone_required'),
            'question.required'     => __('ticket.validation.question_required'),
        ];
    }

}
