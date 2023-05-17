<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;
use Modules\Blog\Models\Post;

class NewsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $posts)
    {
        $this->email = $email;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $posts = $this->posts;

        $unsubscribeURL = URL::signedRoute('website.news-unsubscribe.show', ['email' => $this->email]);

        return $this->subject(__('emails.news.subject'))->view('emails.news', compact('posts', 'unsubscribeURL'));
    }
}
