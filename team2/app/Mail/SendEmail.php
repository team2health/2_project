<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    // public $data;
    public $data;
    public $user_email; // 새로 추가한 프로퍼티

    public function __construct($data)
    {
        $this->data = $data;
        $this->user_email = $data['name'];
    }

    public function build()
    {
        return $this->subject("건강하시조 이메일인증 코드 보내드립니다.")
        ->view('emailsend');
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Signup Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
