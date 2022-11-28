<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(AuthRequest $request){

        $validate = $request->validated();

        if(Auth::attempt($validate)){

            return redirect()->intended(route('homeAdmin'));

        }

        return redirect()->back()->withErrors([
            'password' => 'неверные логин или пароль!'
        ]);
    }


    
}
