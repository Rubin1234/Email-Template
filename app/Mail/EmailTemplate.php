<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Entities\EmailTemplate as Template;
use App\Mail\AwsSesMail;
use Exception;
use Illuminate\Support\Facades\Mail;

class EmailTemplate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $title;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $body)
    {
        $this->body = $body;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('pasangyangji07@gmail.com', 'Example')
            ->subject($this->title)
            ->view('emails.index');
    }


    public function failed(Exception $exception)
    {

        $response = Mail::mailer('ses')->to('rubinawale10@gmail.com')
            ->send(new EmailTemplate($this->title, $this->body));


        // Send user notification of failure, etc...
    }
}
