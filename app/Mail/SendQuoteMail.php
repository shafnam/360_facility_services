<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendQuoteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $quote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quote_details)
    {
        $this->quote = $quote_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('mails.quote-mail')->to('shafnamikdar@outlook.com');
        $email =  $this->from('admin@360degreesfs.com.au', '360 Degrees FS')
            ->subject('Quotation #'. $this->quote['quote_number']. ' | 360 Degrees Facility Services')
            ->cc(['shafnawitel@gmail.com'])
            ->view('mails.quote-mail')
            ->with('quote', $this->quote);

            // $attachments is an array with file paths of attachments
            foreach($this->quote['attachments'] as $attachment){
                //dd($attachment['file_path']);
                $email->attach($attachment['file_path'],
                [
                    'as' => $attachment['file_name'],
                    'mime' => 'application/pdf',
                ]);
            }

        return $email;
    }
}
