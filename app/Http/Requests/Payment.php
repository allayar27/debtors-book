<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Payment extends FormRequest
{
    

    public function authorize()
    {
        return auth()->check();
    }

    
    

    public function rules()
    {
        return [
            'pay_amount' => 'required|numeric',
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
        ]);
        
    }
}
