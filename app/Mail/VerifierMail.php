<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifierMail extends Mailable
{
    use Queueable, SerializesModels;

    public $activationLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($activationLink)
    {
        $this->activationLink = $activationLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.verifier-mail');
    }
}
