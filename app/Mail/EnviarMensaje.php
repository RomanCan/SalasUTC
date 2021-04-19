<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\EnviarEmail;
use Illuminate\Mail\Message;

class EnviarMensaje extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Solicitud de laboratorio";
    // public $d;
    public $enviar;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

        // $this->msg = $msg;
        // $this->d = $d;
        // $this->enviar = $enviar;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.contactanos');
    }
}