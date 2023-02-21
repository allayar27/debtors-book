<?php

namespace App\Http\Controllers\Auth;

use App\Actions\UpdateUserPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function login(AuthRequest $request){

      $valid = $request->validated();

        if(Auth::attempt($valid)) {
            return redirect()->intended(route('dashboard'))->with('success', 'Вы успешно вошли в систему!');
        }
        return redirect()->back()->withErrors([
            'password' => 'неверные логин или пароль!'
        ]);

    }

    public function showForgotForm()
    {
        return view('auth.forgot');
    }


    public function forgot(ForgotPasswordRequest $request, UpdateUserPassword $action)
    {
        $validate = $request->validated();
        $user = User::where(['email' => $validate['email']])->first();
        $action->handle($user);
        return redirect(route('forgot'))->with('success', 'Данные вам успесно отправлены.');
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Вы успешно вышли из системы!');
    }


}
