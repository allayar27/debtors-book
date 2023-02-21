<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class UserObserver
{

    public function created(User $user)
    {
        $employee = $user->all();
        Notification::send($employee, new UserNotification($user));
    }


    public function updated(User $user)
    {
        $admin = $user->all();
        Notification::send($admin, new UserNotification($user));
    }


    public function deleted(User $user)
    {
        //
    }


    public function restored(User $user)
    {
        //
    }


    public function forceDeleted(User $user)
    {
        //
    }
}
