<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(AuthRequest $request){
        
      $valid = $request->validated();

        if(Auth::attempt($valid)){
            
            return redirect()->intended(route('homeAdmin'));
        }

        return redirect()->back()->withErrors([
            'password' => 'неверные логин или пароль!'
        ]);

    }



}
