<?php

namespace App\Console;

use App\Models\NewsSubscribesSetting;
use Dotenv\Dotenv;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Modules\Graybull\Services\GraybullService;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
//        'App\Console\Commands\AccrueProfit',
//        'App\Console\Commands\ChargeBalance',
//        'App\Console\Commands\RepairAccrue',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        Log::info('***CR0N RUN!');

        $schedule->command('AccrueProfit:Run')->daily();
        $schedule->command('UpdateMentorBonusLevel:Run')->daily();


//        $schedule->command('AccrueProfit:Run')->everyMinute();

//        $schedule->command('AccrueProfit:Run')->daily();
//        $schedule->command('UpdateMentorBonusLevel:Run')->daily();

        //$schedule->command('accrue:leadership_bonus')->monthly();
        //$schedule->command('SendNewsOnEmail:send', ['--period' => 'month'])->everyMinute();
        //$schedule->command('SendNewsOnEmail:send', ['--period' => 'week'])->everyMinute();
        // $schedule->command('PartnersMapSubscription:run')->daily();
        //$schedule->command('ResetInvite:Run')->everyMinute();

//         $schedule->call(function () {
//             GraybullService::controlBets();
//         })->everyMinute();

        //$schedule->command('backup:run --only-db')->daily()->environments(['production']);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
