<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required'],
            'features' => ['required'],
            'weight'=> ['nullable'],
            'height'=> ['nullable'],
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:2048'],
            'number_of_days' => ['required'],
        ];
    }
}
