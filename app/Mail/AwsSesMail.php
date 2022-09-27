<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Entities\EmailTemplate as Template;

class AwsSesMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Template $emailTemplate)
    {
        $this->emailTemplateData = $emailTemplate;
    }

    /**

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('rubinawale10@gmail.com', 'Example')
            ->subject($this->emailTemplateData->title)
            ->view('emails.index');
    }
}
