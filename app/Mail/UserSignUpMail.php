<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSignUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    
    public function build()
    {
        return $this->subject('Спасибо вам что вы зарегистрировались в нашем сайте')
                    ->markdown('mails.welcome')->with('data', $this->data);
    }
}
