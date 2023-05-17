<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Auth\User;

class PartrnersMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id, $title, $content)
    {
        $this->user = User::find($user_id);
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $content = $this->content;
        $title = $this->title;

        return $this->subject(__('emails.partners.subject'))->view('emails.partners-emails', compact('content', 'user', 'title'));
    }
}
