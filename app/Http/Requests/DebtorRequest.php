<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebtorRequest extends FormRequest
{
    

    public function authorize()
    {
        return auth()->check();
    }

    

    public function rules()
    {
        return [
            'name' => 'required|string|min:2',
            'phone' => 'required|integer|min:9|unique:debtors',
            'user_id' => 'required|numeric|exists:users,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }
}
