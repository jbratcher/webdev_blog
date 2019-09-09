<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\ContactEmail;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactEmail $contact_email)
    {
        $this->contact_email = $contact_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.contact');

    }
}
