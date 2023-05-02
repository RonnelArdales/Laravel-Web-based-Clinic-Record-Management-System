<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PatientDocument extends Mailable
{
    use Queueable, SerializesModels;
    public $fullname;
    public $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname, $date)
    {
        $this->fullname = $fullname;
        $this->date = $date;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Patient Document',
        );
    }

    
    public function build()
    {
        $fullname = $this->fullname;
        $date = $this->date;
   
        return $this->markdown('mail.patientdocument', compact('fullname','date' ));
      
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.patientdocument',
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
