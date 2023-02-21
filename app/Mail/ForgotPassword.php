<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $password;
    /**
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forgot')->with([
            'password' => $this->password
        ]);
    }
}
