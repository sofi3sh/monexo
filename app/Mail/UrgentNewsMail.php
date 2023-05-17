<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class UrgentNewsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $post)
    {
        $this->email = $email;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $post = $this->post;
        $unsubscribeURL = URL::signedRoute('website.news-unsubscribe.show', ['email' => $this->email]);

        return $this
                ->subject(__('emails.urgent-news.subject'))
                ->view('emails.urgent-news', compact('post', 'unsubscribeURL'));
    }
}
