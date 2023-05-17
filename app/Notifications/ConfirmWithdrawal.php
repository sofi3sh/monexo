<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmWithdrawal extends Notification
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
        $emailCode = rand(1000, 9999);
        session()->put('withdraw_verification',$emailCode);
        $data = [
            'user_id' => \Auth::user()->id,
            'code' => $emailCode,
        ];
        \App\Models\WithdrawVerification::insert($data);
        return (new MailMessage)
            ->greeting(__('Hello', [], $notifiable->locale) . ", {$notifiable->name}")
            ->salutation(__('Regards', [], $notifiable->locale) . ', ' . config('app.name'))
            ->subject(__('Confirm withdrawal', [], $notifiable->locale))
            //->line("Are you accepting the payout in Dinway company? If you create an application please follow the link (".url('/verify-withdrawal/'.$this->data['token'])."). If you don't create any application in personal account of Dinway company you should write to our support : https://t.me/ritofos_support")
            //->action('Confirm Withdrawal', url('/verify-withdrawal/'.$this->data['token']))
            ->line(__('notifications.authorisation.withdraw_verification_code', [], $notifiable->locale))
            ->line(__('notifications.authorisation.verification_code', [], $notifiable->locale) . $emailCode)
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
