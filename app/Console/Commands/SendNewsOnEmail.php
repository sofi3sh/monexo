<?php

namespace App\Console\Commands;

use App\Mail\NewsMail;
use App\Models\NewsSubscribe;
use App\Models\NewsSubscribesSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Blog\Models\Post;

class SendNewsOnEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNewsOnEmail:send {--period=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить письма о новостях проекта';

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
        $period = $this->option('period');
        $currentDate = Carbon::now();
        $settings = NewsSubscribesSetting::find(1);

        $day = Carbon::parse($currentDate)->format('d');
        $dayOfWeek = $currentDate->dayOfWeek;
        $time = Carbon::parse($currentDate)->format('H:i');

        $go = false;

        if ($period === 'week' && $dayOfWeek == $settings->week_day && $time == $settings->week_dispatch_time) {
            $go = true;
        } else if ($period === 'month' && $day == $settings->month_day && $time == $settings->month_dispatch_time) {
            $go = true;
        }

        if($go) {
            
            $recipients = NewsSubscribe::where('period', $period)->get();

            $periodsMap = [
                'week' => 7,
                'month' => 30
            ];

            $posts = Post::published()
                        ->where('category_id', '!=', POST::URGENT_NEWS_ID)
                        ->whereBetween('created_at', [
                            Carbon::now()->subDays($periodsMap[$period]),
                            Carbon::now()
                        ])
                        ->orderBy('created_at')
                        ->get();

            if(count($posts) > 0) {
                try {
                    foreach ($recipients as $recipient) {
                        $this->info($recipient->email);
                        
                        $locale = $recipient->user->locale ?? 'ru';
        
                        Mail::to($recipient->email)
                            ->locale($locale)
                            ->send(new NewsMail($recipient->email, $posts));
        
                    }
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
        
    }
}
