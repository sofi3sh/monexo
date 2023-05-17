<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteDepositMail extends Mailable
{
    use Queueable, SerializesModels;

    private array $content;

    /**
     * InviteDepositMail constructor.
     *
     * @param array $content
     */
    public function __construct( array $content )
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('notifications.invite.theme'))
            ->view('emails.invite_deposit')
            ->with( 'content', $this->content );
    }
}
