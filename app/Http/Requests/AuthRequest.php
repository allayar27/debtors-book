<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
