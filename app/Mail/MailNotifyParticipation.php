<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotifyParticipation extends Mailable
{
    use Queueable, SerializesModels;
    private $data=[];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Mail Notify Participation',
        );
    }

    public function build()
    {
        return $this->from('tavyissa563@gmail.com','AutoRoad')
        ->subject($this->data['subject'])
        ->view('Frontoffice.mailNotifEvent')
        ->with('data', $this->data);
    }
}
