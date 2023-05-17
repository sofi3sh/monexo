<?php

namespace App\Services;

use App\Jobs\SendMessageJob;
use App\Models\User;
use DB;
use Log;

class MailSendService
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function send($info)
    {
        $users = [];

        if($this->type === 'referrers')
        {
            $users = DB::select("SELECT DISTINCT parent.email, parent.locale  FROM users u JOIN users parent on (parent.id = u.parent_id) GROUP by parent.id");
        }
        else if($this->type === 'all')
        {
            $users = User::select('email', 'locale')->whereNull('deleted_at')->get();
        }

        Log::channel('email-message')->info('Идет отправка писем для: ' .  count($users) . ' пользователей. Тип: ' . $this->type);

        foreach($users as $user)
        {
            $locale  = $user->locale;
            $email   = $user->email;
            $subject = $info['subject'][$locale];
            $title   = $info['title'][$locale];
            $content = $info['content'][$locale];

            $job = new SendMessageJob($locale, $email, $subject, $title, $content);

            dispatch($job);
        }
    }
}
