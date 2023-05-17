<?php

namespace App\Jobs;

use App\Mail\MessageMail;
use App\Services\MailSendService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use Mail;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $subject;
    private string $title;
    private string $content;
    private string $locale;
    private string $email;

    /**
     * Create a new job instance.
     * @param string $locale
     * @param string $email
     * @param string $subject
     * @param string $title
     * @param string $content
     */
    public function __construct(string $locale, string $email, string $subject, string $title, string $content)
    {
        $this->locale   = $locale;
        $this->email    = $email;
        $this->subject  = $subject;
        $this->title    = $title;
        $this->content  = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->email)->locale($this->locale)
            ->send(new MessageMail($this->subject, $this->title, nl2br($this->content))
            );
            Log::channel('email-message')->info('Отправлено сообщение на: ' . $this->email . ' Тема: ' . $this->subject);
        } catch(\Exception $e) {
            Log::channel('email-message')->error($e->getMessage());
        }

    }
}
