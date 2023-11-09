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
    public $file_path;
    public $note;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname, $date, $path_file, $note)
    {
        $this->fullname = $fullname;
        $this->date = $date;
        $this->file_path = $path_file;
        $this->note = $note;
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
        $file_path = $this->file_path;
        $note = $this->note;
        
        // Check if the $note contains the word "Password"
    if (stripos($note, 'Password') !== false || stripos($note, 'password') !== false) {
        $passwordLine = "Password: ";
 
        $note = str_ireplace('Password', $passwordLine . '<br><br>Password', $note);
    }

        return $this->markdown('mail.patientdocument', compact('fullname','date', 'note'))->attach($file_path, [
            'as' =>  $fullname ."_" . $date. '.pdf', // The name to display for the attached file
            'mime' => 'application/pdf', // Change the MIME type according to your file type
        ]);
      
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
