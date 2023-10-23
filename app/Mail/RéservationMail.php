<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RéservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;
    public $dateDepart;
    public $heureDepart;
    public function __construct($emailData, $dateDepart, $heureDepart)
    {
        $this->emailData = $emailData;
        $this->dateDepart = $dateDepart;
        $this->heureDepart = $heureDepart;
     
    }
    
 
    
    
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Réservation Mail',
        );
    }

   
public function build()
{
    return $this->from('tavyissa563@gmail.com', 'AutoRoad')
        ->subject($this->emailData['subject'])
        ->view('FrontOffice.Réservation.réservationMail')
        ->with('data', $this->emailData)
        ->with('dateDepart', $this->dateDepart)
        ->with('heureDepart', $this->heureDepart)
        ; // Passer l'adresse e-mail du destinataire
}

}
