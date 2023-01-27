<?php

namespace app\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use app\Http\Requests\ContactRequest;

class ContactInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactRequest $request)
    {
        $this->email = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     
    public function build()
    {
        return $this->subject('User wants to contact you')
          ->from($this->email->email)
          /*->to('info@klaipedaassutavim.lt')*/
          ->to('info@klaipedaassutavim.lt')
          ->view('mail.contactInquiry');
    }
}
