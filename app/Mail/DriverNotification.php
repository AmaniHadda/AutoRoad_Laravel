<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DriverNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $driver;
    public $reclamationSubject;
    public $reclamationMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($driver, $reclamationSubject, $reclamationMessage)
        {
            $this->driver = $driver;
            $this->reclamationSubject = $reclamationSubject;
            $this->reclamationMessage = $reclamationMessage;
        }
            
        public function build()
        {
            return $this->view('emails.send-email-to-driver') // Use the name of your view
                ->subject($this->reclamationSubject)
                ->with([
                    'driver' => $this->driver,
                    'reclamationSubject' => $this->reclamationSubject,
                    'reclamationMessage' => $this->reclamationMessage,
                ]);
        }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have a new message from the admin.')
            ->action('Read Message', url('/'))
            ->line('Thank you for using our application!');
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Driver Notification',
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
