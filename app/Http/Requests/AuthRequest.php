<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
   
    public function authorize():bool
    {
        return true;
    }

    
    public function rules():array
    {
        return [

            'email' => 'required|string|email|exists:users',
            'password' => 'required|string|min:8'

        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'Пользователь с таким логином не существует!',
            'password.min' => 'Пароль должен быть не менее 8 символов!',

        ];
    }
}
