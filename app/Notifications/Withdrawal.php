<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class Withdrawal extends Notification
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
        return ['mail', TelegramChannel::class];
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
            ->subject(__('Withdrawal processed', [], $notifiable->locale))
            ->line(trans('notifications.email.withdrawal_processed', [
                'amount' => $this->data['amount'] . ' ' . $this->data['code'],
            ], $notifiable->locale));
    }

    /**
     * @param $notifiable
     * @return TelegramMessage|\NotificationChannels\Telegram\Traits\HasSharedLogic|null
     */
    public function toTelegram($notifiable)
    {
        if (!$notifiable->telegram_id) {
            return null;
        }

        return TelegramMessage::create()
            ->to($notifiable->telegram_id)
            ->content(
                __('Withdrawal processed', [], $notifiable->locale) . "\n" .
                __('Hello', [], $notifiable->locale) . ", {$notifiable->name}" . "\n" .
                trans('notifications.email.withdrawal_processed', ['amount' => $this->data['amount'] . ' ' . $this->data['code']], $notifiable->locale) . "\n" .
                __('Regards', [], $notifiable->locale) . ', ' . config('app.name')
            );
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
