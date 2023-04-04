<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    
    public function authorize():bool
    {
        return true;
    }

    
    public function rules():array
    {
        return [
            'name' => 'required|string|max:55',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
