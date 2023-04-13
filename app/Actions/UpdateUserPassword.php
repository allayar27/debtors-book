<?php

namespace App\Actions;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UpdateUserPassword
{
    /** @param User $user **/
    public function handle(User $user)
    {
        $password = Str::random();
        $user->password = $password;
        $user->save();
        Mail::to($user)->send(new ForgotPassword($password));
    }
}
