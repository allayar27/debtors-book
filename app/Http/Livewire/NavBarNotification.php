<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavBarNotification extends Component
{
    

    public function marked($id)
    {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    }


    public function render()
    {
        return view('livewire.notifications.nav-bar-notification', [
            'notifications' => auth()->user()->unreadNotifications()
                            ->take(5)->get()->toArray()
        ]);
    }
}
