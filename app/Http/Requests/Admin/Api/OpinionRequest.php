<?php

namespace App\Http\Requests\Admin\Api;

use Illuminate\Foundation\Http\FormRequest;

class OpinionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2'],
            'content' => ['required', 'min:3']
        ];
    }
}
