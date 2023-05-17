<?php

namespace App\Console\Commands;

use App\Models\Home\UserMarketingPlan;
use App\Models\Param;
use App\Models\User;
use http\Params;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Models\Home\MarketingPlan;

class GenerateDemoReferralsUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:DemoReferralsUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Генерирование демо-реферальных пользователей всем пользователям в демо-режиме.';

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
        DB::beginTransaction();
        try {
            $this->accrue_log = new Logger('accrues');
            $this->accrue_log->pushHandler(new StreamHandler(storage_path('logs/gen_demo_referrals_' . date("m-d-y") . '.log')), Logger::INFO);
            $faker = Faker::create();
            User::where('demo_mode', true)->chunk(100, function ($users) use ($faker) {
                // Для каждого пользователя, находящегося в демо-режиме
                $users->each(function ($user) use ($faker) {
                    // Определяем, сколько у текущего пользователя уже есть рефералов
                    $descendants = $user->getAllLevelsDescendants(20);
                    // До 8 рефералов - всех добавляем в первую линию
                    if ($descendants->count() < 8) {
                        $randDescendantId = $user->id;
                    } else {
                        // Берем случайного реферала
                        $randDescendantId = $descendants->random()->id;
                    }

                    // Присваиваем случайный баланс
                    $balance_usd = $faker->biasedNumberBetween(
                        Param::where('name', 'min_referal_user_demo_balance')->first()->value,
                        Param::where('name', 'max_referal_user_demo_balance')->first()->value
                    );
                    // Создаем пользователя с уникальным email
                    do {
                        $email = $faker->email;
                    } while (!is_null(User::where('email', $email)->first()));

                    $referralUser = User::create([
                        'name'               => $faker->name,
                        'email'              => $email,
                        'phone'              => '+' . $faker->tollFreePhoneNumber,
                        'country'            => $faker->country,
                        'age'                => $faker->biasedNumberBetween($min = 18, $max = 70),
                        'add_contact'        => $faker->e164PhoneNumber,
                        'locale'             => $faker->languageCode,
                        'ref_code'           => '',
                        'is_trading_account' => false,
                        'parent_id'          => $randDescendantId,
                        'balance_usd'        => $balance_usd,
                        'invested_usd'       => $balance_usd,
                        'password'           => Hash::make($faker->password),
                        'demo'               => 1,
                    ]);
                    $referralUser->save();

                    // Покупаем пользователю маркетинг-план
                    $this->buyMarketingPlan($referralUser);
                });
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $this->info($e->getMessage());
        }
        $end = date('Y-m-d H:i:s');
        $this->info('End   ' . $end);
    }

    /**
     * Покупка маркетингового плана
     */
    public function buyMarketingPlan($user)
    {
        // Определяем, какой макс. маркетинговый план может купить пользователь
        $maxPlanId = MarketingPlan::where('min_invest_sum', '<', $user->balance_usd)->orderBy('id', 'desc')->first()->id;
        $userMarketingPlan = new UserMarketingPlan();
        //  Покупаем план пользователю
        $userMarketingPlan->fill([
            'user_id'           => $user->id,
            'marketing_plan_id' => $maxPlanId,
            'invested_usd'      => $user->balance_usd,
            'balance_usd'       => $user->balance_usd,
            'start_at'          => Carbon::now(),
        ]);
        $userMarketingPlan->save();
    }
}
