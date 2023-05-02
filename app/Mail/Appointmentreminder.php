<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Appointmentreminder extends Mailable
{
    use Queueable, SerializesModels;
    public $fullname;
    public $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname, $time)
    {
        $this->fullname = $fullname;
        $this->time = $time;
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Appointment reminder',
        );
    }

    public function build()
    {
        $fullname = $this->fullname;
        $time = $this->fullname;
        return $this->markdown('mail.appointmentreminder', compact('fullname', 'time'));
      
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.appointmentreminder',
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
