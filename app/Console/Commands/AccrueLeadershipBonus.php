<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Home\{Alert, Transaction, Bonus};
use App\Models\Consts\{AlertType, TransactionsTypesConsts};
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AccrueLeadershipBonus extends Command
{
    const BONUS_START_DATE = '2021-01-22';

    /** @inheritDoc */
    protected $signature = 'accrue:leadership_bonus {--without-start-date : Без фильтрации по дате начала бонуса}';

    /** @inheritDoc */
    protected $description = 'Начислить лидерский бонус пользовтаелям';

    private $startDateTime;
    private $endDateTime;
    private $maxBonusLevel;
    private $withoutStartDate = false;
    private $numberOfProcessedUsers = 0;

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
     * Prepare basic data
     */
    public function prepare()
    {
        $this->startDateTime = now()->subMonth()->startOfDay()->toDateTimeString();
        $this->endDateTime = now()->subDay()->endOfDay()->toDateTimeString();
        $this->maxBonusLevel = Bonus::where('is_active', '=', 1)->max('level');
    }

    /**
     * Execute the console command.
     *
     * @throws \Throwable
     */
    public function handle()
    {
        $this->prepare();

        ini_set('memory_limit', '4096M');

        $this->comment('Начало начисления лидерского бонуса [' . now()->toDateTimeString() . ']');

        if ($this->option('without-start-date')) {
            if ($this->confirm('Запустить начисление лидерского бонуса без учета даты начала его действия? (' . self::BONUS_START_DATE . ')')) {
                $this->withoutStartDate = true;
            }
        }

        DB::transaction(function () {
            User::with('userBonus:id,leadership_bonus')
                ->whereHas('userBonus', function ($query) {
                    return $query->whereNotNull('leadership_bonus');
                })
                ->each(function (User $user) {
                    $amountUsd = $this->getUserTeamTurnover($user) / 100 * $user->userBonus->leadership_bonus;

                    if (!$amountUsd) return;

                    Transaction::create([
                        'user_id' => $user->id,
                        'transaction_type_id' => TransactionsTypesConsts::LEADERSHIP_BONUS,
                        'amount_usd' => $amountUsd,
                        'balance_usd_after_transaction' => $user->balance_usd + $amountUsd,
                    ]);

                    Alert::create([
                        'user_id' => $user->id,
                        'alert_id' => AlertType::LEADERSHIP_BONUS,
                        'amount' => $amountUsd,
                    ]);

                    $this->numberOfProcessedUsers++;
                }, 25);
        });

        $period = implode(' по ', [
            $this->startDateTime,
            $this->endDateTime
        ]);

        $this->comment('Конец начисления лидерского бонуса [' . now()->toDateTimeString() . ']');

        $infoText = "Лидерский бонус начислен количеству пользователей {$this->numberOfProcessedUsers} за период с {$period}";

        $this->info($infoText);

        logger()->info($infoText);
    }

    /**
     * @param User $user
     * @return float|null
     * @see User::teamTurnover()
     */
    private function getUserTeamTurnover(User $user): ?float
    {
        $userIds = $user->getDepthData($this->maxBonusLevel)['all'];

        // Отсекаем первую линию
        $userIds = array_filter($userIds, function ($var) {
            return $var !== 1;
        });

        $userIds = array_keys($userIds);

        return Transaction::whereIntegerInRaw('user_id', $userIds)
            ->when(!$this->withoutStartDate, function ($query) {
                $query->whereDate('created_at', '>', self::BONUS_START_DATE);
            })
            ->whereBetween('created_at', [$this->startDateTime, $this->endDateTime])
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE,
                TransactionsTypesConsts::SERVICES_REFERRAL_TEAM_TURNOVER,
            ])
            ->value(DB::raw("ABS(SUM(amount_usd) + IFNULL(sum(amount_crypto),0))"));
    }
}
