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
        $email =  $this->from('info@360degreesfs.com.au', '360 Facility Services')
            ->subject('360 Facility Services Quotation')
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
                    // 'as' => $this->quote['document']->getClientOriginalName(),
                    // 'mime' => $this->quote['document']->getClientMimeType(),
                ]);
            }
            //dd($email);
            // ->attach($this->quote['file_path'],
            //     [
            //         'as' => $this->quote['file_name'],
            //         'mime' => 'application/pdf',
            //         // 'as' => $this->quote['document']->getClientOriginalName(),
            //         // 'mime' => $this->quote['document']->getClientMimeType(),
            //     ]);

        return $email;
    }
}
