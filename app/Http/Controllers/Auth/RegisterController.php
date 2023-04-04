<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        if(auth()->check()){
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        $valid = $request->validated();

        $valid['password'] = bcrypt($request['password']);
        $user = User::create($valid);

        if($user) {
            auth()->login($user);
            return redirect()->route('dashboard')->with('success', 'Вы успешно зарегистрировались!');
        }

        return redirect()->route('/');

    }
}
