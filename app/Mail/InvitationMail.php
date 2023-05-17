<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Messages\MailMessage;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $sender;
    private $mailLocale;

    public function __construct(User $sender, string $mailLocale = 'ru')
    {
        $this->sender = $sender;
        $this->mailLocale = $mailLocale;
    }

    public function build()
    {
        $mailData = (new MailMessage)
            ->greeting(__('Hello', [], $this->mailLocale))
            ->salutation(__('Regards', [], $this->mailLocale) . ', ' . config('app.name'))
            ->line(new HtmlString(trans('notifications.email.user_invitation_text', ['user' => $this->sender->name])))
            ->action(__('Your invitation link'), $this->sender->getReferralLink())
            ->data();

        return $this->markdown('vendor.notifications.email', $mailData)
            ->subject(__('Dinway invitation', [], $this->mailLocale));
    }
}
