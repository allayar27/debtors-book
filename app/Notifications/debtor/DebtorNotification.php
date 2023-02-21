<?php

namespace App\Notifications\debtor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DebtorNotification extends Notification
{
    use Queueable;

    public $debtor;

    public function __construct($debtor)
    {
        $this->debtor = $debtor;
    }



    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'debtor_name' => $this->debtor->name,
            'phone' => $this->debtor->phone,
            'reserve_phone' => $this->debtor->reserve_phone,
        ];
    }
}
