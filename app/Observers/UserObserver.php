<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class UserObserver
{

    public function created(User $user)
    {
        $admin = $user->whereId(1)->get();
        Notification::send($admin, new UserNotification($user));
    }

}
