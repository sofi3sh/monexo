<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredViaSocialNetwork extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(__('Hello', [], $notifiable->locale) . ", {$notifiable->name}")
            ->subject(__('Registration via social networks', [], $notifiable->locale))
            ->line(__('You registered through a social network, if in the future you want to log in using your mail and password, you need to', [], $notifiable->locale))
            ->action(__('Set password', [], $notifiable->locale), route('home.profile.profile'))
            ->line(__('notifications.email.verifyEmail.line2', [], $notifiable->locale))
            ->salutation(__('Regards', [], $notifiable->locale) . ', ' . config('app.name'));
    }
}
