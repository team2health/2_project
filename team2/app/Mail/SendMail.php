<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_email)
    {
        $this->email = $user_email;
    }

    function build() {
        return $this
        ->subject('건강하시조 인증코드')
        ->markdown('sendEmail')
        ->with(['verification_code' => $this->email['verification_code']]);;
    }
}
