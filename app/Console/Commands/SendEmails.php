<?php

namespace App\Console\Commands;

use App\Mail\MessageMail;
use App\Models\User;
use DB;
use Illuminate\Console\Command;
use Log;
use Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendEmails:sendAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить письмо всем пользователям';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
        $users = DB::select("SELECT DISTINCT parent.email, parent.locale  FROM users u JOIN users parent on (parent.id = u.parent_id) GROUP by parent.id");
        
        $this->info("Всего: " . count($users) . " получателей");

        $subject = [
            'ru' => 'Dinway. У нас повилась тикет система!',
            'en' => 'Dinway. We have a ticket system!',
        ];
        
        $title = [
            'ru' => 'Удобная тикет система!',
            'en' => 'Convenient ticket system!',
        ];

        $content = [
            'ru' => "Введена удобная тикет система, которая позволяет обрабатывать заявки намного быстрее и ускорить решение вопросов, с которыми сталкиваются ваши партнеры первой линии.

            С этого момента, все заявки, из категорий представленных ниже, обрабатываются непосредственно вами, вы как лидер, вся первая линия обращается по всем вопросам из данных категорий, лично к вам через систему тикетов.
            
            Стандартный регламент обработки заявки составляет 7 рабочих дней.
            
            Отделы:
            
            - технические сложности (обращение уходит в компанию);
            - партнёрская программа (обращение уходит в раздел Тикеты наставнику);
            - пассивный доход (обращение уходит в раздел Тикеты наставнику);
            - пополнение/вывод (обращение уходит в компанию);
            - нововведения на сайте (обращение уходит в раздел Тикеты наставнику);
            - продукты компании (обращение уходит в раздел Тикеты наставнику);
            - события компании (обращение уходит в раздел Тикеты наставнику).
            
            Просим обратить внимание, что теперь обработка всех вопросов и сложностей при использовании платформы Dinway, происходит исключительно, через данную систему тикетов, и никакие чаты, боты, личные сообщения с кем-либо не являются поддержкой и не имеют отношения к регламенту компании.
            
            Всегда рады помочь!
            
            С уважением, компания DinWay!
            ",
            'en' => "A convenient ticket system has been introduced, which allows you to process applications much faster and speed up the resolution of issues that your first line partners face.

            From this moment, all applications from the categories presented below are processed directly by you, you as a leader, the entire first line addresses all questions from these categories, personally to you through the ticket system.
            
            The standard procedure for processing an application is 7 working days.
            
            Departments:
            
            - technical difficulties (the appeal goes to the company);
            - affiliate program (the appeal goes to the section Tickets to the mentor);
            - passive income (the appeal goes to the section Tickets to the mentor);
            - replenishment / withdrawal (the appeal goes to the company);
            - innovations on the site (the appeal goes to the section Tickets to the mentor);
            - products of the company (the appeal goes to the section Tickets to the mentor);
            - events of the company (the appeal goes to the section Tickets to the mentor).
            
            Please note that now the processing of all questions and difficulties when using the Dinway platform occurs exclusively through this ticket system, and no chats, bots, private messages with anyone are support and have nothing to do with the company's regulations.
            
            Always happy to help!
            
            Best regards, DinWay company!
            ",
        ];

        $counter = 0;

        try {
            
            foreach ($users as $user) {
                $locale = $user->locale;
                $email = $user->email;

                $this->info($email);

                Mail::to($user->email)
                    ->locale($locale)
                    ->send(new MessageMail($subject[$locale], $title[$locale], nl2br($content[$locale])));
                
                $counter++;
                
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->error($e->getMessage());
            $this->info("Было отправлено $counter писем");
        }

        $this->info("Было отправлено $counter писем");

    }
}
