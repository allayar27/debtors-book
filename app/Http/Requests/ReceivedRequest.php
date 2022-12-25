<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceivedRequest extends FormRequest
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
            'received_amount' => 'required|numeric',
            'transaction_remark' => 'required',
            'transaction_type' => 'required',
            'debtor_id' => 'required|numeric|exists:debtors,id',
            'user_id' => 'required|numeric|exists:users,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
            'transaction_type' => 'r'
        ]);
        
    }
}
