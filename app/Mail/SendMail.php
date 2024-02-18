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

    public $subject;
    public $content;
    public $emailData;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $content, $emailData)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->emailData = $emailData;
    }

    public function build()
    {
        return 
        $this->subject($this->subject)
        ->view($this->content)
        ->with($this->emailData);
    }
}
