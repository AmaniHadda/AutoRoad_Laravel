<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName; 
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Paiement Receipt',
        );
    }

    public function build()
    {
        try {
            return $this->from('tavyissa563@gmail.com', 'AutoRoad')
                ->subject('Paiement Receipt') 
                ->view('invoices.mail')
                ->attach(storage_path('app/uploads/' . $this->fileName), [
                    'as' => 'invoice.pdf',
                ]);
        } catch (\Exception $e) {
            \Log::error('Error building Invoice Email: ' . $e->getMessage());
            return $this->from('tavyissa563@gmail.com', 'AutoRoad')
                ->subject('Error in Email Building')
                ->view('emails.error') // Create a custom error email view if needed
                ->with('error', $e->getMessage());
        }
    }
    
}
