<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Messages\MailMessage;

class SocialNetworksMail extends Mailable
{
    use Queueable, SerializesModels;

    private $recipient;

    public function __construct($recipient)
    {
        $this->recipient = $recipient;
    }

    public function build()
    {
        $mailData = (new MailMessage)
            ->greeting(__('Hello', [], $this->recipient->locale) . ', ' . $this->recipient->name)
            ->salutation(__('Regards', [], $this->recipient->locale) . ', ' . config('app.name'))
            ->line(__('Dinway is an active social media company and has a Telegram community', [], $this->recipient->locale))
            ->line(__('Keep in touch and do not miss interesting and important news!', [], $this->recipient->locale))
            ->line(new HtmlString("<strong>" . __('Links to our social networks', [], $this->recipient->locale) . "</strong>"))
            ->line(new HtmlString('<a href="https://www.facebook.com/groups/ritofoscommunity">Facebook</a>'))
            ->line(new HtmlString('<a href="https://www.instagram.com/ritofoscommunity">Instagram</a>'))
            ->line(new HtmlString('<a href="https://t.me/ritofoscommunity">Telegram</a>'))
            ->line(new HtmlString('<a href="https://t.me/joinchat/AAAAAE5XvPwHkId2qg3JNQ">Telegram CHAT</a>'))
            ->line(new HtmlString('<a href="https://vk.com/ritofoscommunity">VK</a>'))
            ->data();

        return $this->markdown('vendor.notifications.email', $mailData)
            ->subject(__('Dinway social networks', [], $this->recipient->locale));
    }
}
