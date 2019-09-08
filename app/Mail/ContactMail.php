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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $email = ContactEmail::find(1);

        return $this->subject($email->subject)
                    ->from($email->email)
                    ->sender($email->name)
                    ->to('jeremybratcher@gmail.com')
                    ->view(emails.contact)
                    ;
    }
}
