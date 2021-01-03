<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user,$password,$isUpdatePassword,$previusEmail;
    public function __construct($user,$isUpdatePassword,$password,$previusEmail)
    {
        $this->user = $user;
        $this->password = $password;
        $this->isUpdatePassword = $isUpdatePassword;
        $this->previusEmail = $previusEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.user_update');
    }
}
