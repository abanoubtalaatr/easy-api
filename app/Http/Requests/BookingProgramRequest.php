<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingProgramRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'price' => ['required'],
            'program_id' => ['required', 'exists:programs,id'],
            'mobile' => ['required'],
            'payment_type' => ['required', 'in:paypal,tap']
        ];
    }
}
