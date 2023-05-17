<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class Deposit extends Notification
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
        if ($this->data['currency_id'] == 18) {
            $text = trans('notifications.email.deposit', [
                'amount' => $this->data['amount'],
                'payment_system' => ' Payeer',
            ], $notifiable->locale);
        } else if ($this->data['currency_id'] == 22) {
            $text = trans('notifications.email.deposit', [
                'amount' => $this->data['amount'],
                'payment_system' => ' Perfect Money',
            ], $notifiable->locale);
        } else {
            $text = trans('notifications.email.deposit', [
                'amount' => $this->data['amount'] . ' ' . $this->data['code'],
                'payment_system' => '',
            ], $notifiable->locale);
        }

        return (new MailMessage)
            ->line($text);
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

        if ($this->data['currency_id'] == 18) {
            $text = trans('notifications.email.deposit', [
                'amount' => $this->data['amount'],
                'payment_system' => ' Payeer',
            ], $notifiable->locale);
        } else if ($this->data['currency_id'] == 22) {
            $text = trans('notifications.email.deposit', [
                'amount' => $this->data['amount'],
                'payment_system' => ' Perfect Money',
            ], $notifiable->locale);
        } else {
            $text = trans('notifications.email.deposit', [
                'amount' => $this->data['amount'] . ' ' . $this->data['code'],
                'payment_system' => '',
            ], $notifiable->locale);
        }

        return TelegramMessage::create()
            ->to($notifiable->telegram_id)
            ->content(
                __('Buying package', [], $notifiable->locale) . "\n" .
                __('Hello', [], $notifiable->locale) . ", {$notifiable->name}" . "\n" .
                $text . "\n" .
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
