<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $data;

    public function __construct(array $data) {

            $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(__('Hello', [], $notifiable->locale) . ", {$notifiable->name}")
            ->salutation(__('Regards', [], $notifiable->locale) . ', ' . config('app.name'))
            ->subject(__('Password reset', [], $notifiable->locale))
            ->line(__('notifications.authorisation.password_reset', [], $notifiable->locale))
            ->action(__('notifications.authorisation.reset_password', [], $notifiable->locale), url(config('app.url').route('password.reset', ['token' => $this->data['token'], 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(__('notifications.authorisation.thank_you', [], $notifiable->locale));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
