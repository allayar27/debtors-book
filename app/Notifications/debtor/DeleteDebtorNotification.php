<?php

namespace App\Notifications\debtor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteDebtorNotification extends Notification
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

    


    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->debtor->id,
            'debtor_name' => $this->debtor->name,
            'phone' => $this->debtor->phone,
        ];
    }
}
