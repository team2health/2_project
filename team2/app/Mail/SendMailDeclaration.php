<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailDeclaration extends Mailable
{
    use Queueable, SerializesModels;

    public $info;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    function build() {
        return $this
        ->subject('신고내역 처리에 대해 알려드립니다.')
        ->markdown('complaintemail')
        ->with(['data' => $this->info]);;
    }
}
