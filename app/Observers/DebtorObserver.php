<?php

namespace App\Observers;

use App\Models\Debtor;
use App\Models\User;
use App\Notifications\debtor\DebtorNotification;
use App\Notifications\debtor\DeleteDebtorNotification;

use Illuminate\Support\Facades\Notification;

class DebtorObserver
{

    public function created(Debtor $debtor)
    {
        
        $user = User::all();
        Notification::send($user, new DebtorNotification($debtor));
    }



    public function deleting(Debtor $debtor)
    {
        $debtor->transactions()->delete();
    }

    
    public function deleted(Debtor $debtor)
    {
        $user = User::all();
        Notification::send($user, new DeleteDebtorNotification($debtor));
    }


}
