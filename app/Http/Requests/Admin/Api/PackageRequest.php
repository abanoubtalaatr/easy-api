<?php

namespace App\Http\Requests\Admin\Api;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'discount_value_when_renew' => ['required', 'integer'],
            'period' => ['required'],
            'price' => ['required'],
            'member_type' => ['required'],
            'features' => [ 'required'],
            'description' => ['required']
        ];
    }
}
