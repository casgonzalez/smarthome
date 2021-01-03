<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForzeDoorMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $fecha,$userAdmin,$userActive;
    public function __construct($fecha,$userAdmin,$userActive)
    {
        $this->fecha = $fecha;
        $this->userAdmin  = $userAdmin;
        $this->userActive  = $userActive;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.forzar_puerta');
    }
}
