<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingPackageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'package_id' => ['required', 'exists:packages,id'],
            'mobile' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'country' => ['required'],
            'age' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'from_where_know_rawan' => ['required'],
        ];
    }
}
