<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    protected $options;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($options, $data)
    {
        $this->options = $options;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kollab.kobedenshi@gmail.com')
                    ->subject($this->options['subject'])
                    ->text($this->options['template']);
    }
}
