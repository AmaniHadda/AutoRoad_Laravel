<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactEmail extends Mailable
{
    public $contact;
    public $categoryTitle;

    public function __construct($contact, $categoryTitle)
    {
        $this->contact = $contact;
        $this->categoryTitle=$categoryTitle;
    }

    public function build()
    {
        return $this->to('tavyissa563@gmail.com')
            ->subject('Nouveau contact ajouté')
            ->view('FrontOffice.new_contact');
    }
}

