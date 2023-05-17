<?php

namespace Modules\Graybull\Http\Controllers;

use App\Models\Home\Transaction;
use App\Models\Consts\TransactionsTypesConsts;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Carbon;
use Modules\Graybull\Models\{Bet, BetCurrency, BetPayment};
use Modules\Graybull\Http\Requests\{MakeBet, CloseBet};
use Modules\Graybull\Services\UserService;

class GameController extends Controller
{
    /**
     * Получить активную ставку
     *
     * @return JsonResponse
     */
    public function getRules(): JsonResponse
    {
        return response()->json([
            'duration_options' => Bet::DURATIONS,
            'min_amount' => Bet::MIN_AMOUNT,
            'max_amount' => Bet::MAX_AMOUNT,
            'min_rate_diff_to_win' => Bet::MINIMUM_RATE_DIFFERANCE_TO_WIN,
            'bet_opening_commission' => Bet::BET_OPENING_COMMISSION,
            'winning_percentage' => BetPayment::WINNING_PERCENTAGE,
            'cashback_percentage' => BetPayment::CASHBACK_PERCENTAGE,
        ]);
    }

    /**
     * Получить активную ставку
     *
     * @return JsonResponse
     */
    public function getActiveBet(): JsonResponse
    {
        /** @var Bet $activeBet */
        $activeBet = Bet::active()
            ->where('user_id', auth()->id())
            ->first();

        return response()->json($activeBet);
    }

    /**
     * Получить историю ставок
     *
     * @return JsonResponse
     */
    public function getBetHistory(): JsonResponse
    {
        $betsPagination = Bet::closed()
            ->with('payment')
            ->where('user_id', auth()->id())
            ->orderByDesc('opened_at')
            ->select([
                '*',
                DB::raw("DATE_FORMAT(closed_at, '%Y.%m.%d %H:%i') as closed_at"),
            ])
            ->paginate();

        return response()->json($betsPagination);
    }

    /**
     * Получить историю бонусов
     *
     * @return JsonResponse
     */
    public function getBonusHistory(): JsonResponse
    {
        $bonusesPagination = Transaction::where('user_id', auth()->id())
            ->leftJoin('users', 'users.id', '=', 'transactions.related_user_id')
            ->where('transaction_type_id', TransactionsTypesConsts::GRAYBULL_REFERRAL_BONUS)
            ->select([
                'transactions.amount_usd',
                'transactions.amount_btc',
                'transactions.amount_eth',
                'transactions.amount_pzm',
                DB::raw("DATE_FORMAT(FROM_UNIXTIME(transactions.created_at), '%Y-%m-%d %H:%i')"),
                'users.email',
            ])
            ->orderByDesc('transactions.created_at')
            ->paginate();

        return response()->json($bonusesPagination);
    }

    /**
     * Получить статистику игр
     *
     * @return JsonResponse
     */
    public function getGameStatistics(): JsonResponse
    {
        $betQuery = Bet::query()
            ->where('user_id', auth()->id());

        $numberOfGames = $betQuery->count();
        $numberOfWinningGames = (clone $betQuery)->where('status', Bet::STATUS_WIN)->count();
        $numberOfLosingGames = (clone $betQuery)->where('status', Bet::STATUS_LOSS)->count();
        $totalAmount = (clone $betQuery)->selectRaw('SUM(amount_usd) as sum')->first()->sum;
        $totalWinnings = (clone $betQuery)->where('status', Bet::STATUS_WIN)->selectRaw('SUM(amount_usd) as sum')->first()->sum;
        $timeInGame = (clone $betQuery)->selectRaw(' SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) AS sum')->first()->sum;
        $partnerStats = Transaction::where('user_id', auth()->id())
            ->where('transaction_type_id', TransactionsTypesConsts::GRAYBULL_REFERRAL_BONUS)
            ->selectRaw('COUNT(id) as number_of_partner_deals, SUM(amount_usd) as earnings_from_partners')
            ->first();

        if ($numberOfGames) {
            $numberOfWinningGames = $numberOfWinningGames . ' (' . number_format($numberOfWinningGames / $numberOfGames * 100, 1) . '%)';
            $numberOfLosingGames = $numberOfLosingGames . ' (' . number_format($numberOfLosingGames / $numberOfGames * 100, 1) . '%)';
        }

        return response()->json([
            'number_of_games' => $numberOfGames,
            'number_of_winning_games' => $numberOfWinningGames,
            'number_of_losing_games' => $numberOfLosingGames,
            'total_amount' => '$ ' . number_format($totalAmount, 2),
            'total_winnings' => '$ ' . number_format($totalWinnings, 2),
            'number_of_partner_deals' => $partnerStats->number_of_partner_deals,
            'earnings_from_partners' => '$ ' . number_format($partnerStats->earnings_from_partners, 2),
            'time_in_game' => $timeInGame,
            'total_earnings' => '$ ' . number_format($totalWinnings + $partnerStats->earnings_from_partners, 2),
        ]);
    }

    /**
     * Получить данные пользователя
     *
     * @return JsonResponse
     */
    public function getUserData(): JsonResponse
    {
        $authUser = Auth::user();

        return response()->json([
            'balance_usd' => (float)$authUser->balance_usd,
            'balance_btc' => (float)$authUser->balance_btc,
            'balance_eth' => (float)$authUser->balance_eth,
            'balance_pzm' => (float)$authUser->balance_pzm,
            'locale' => $authUser->locale,
        ]);
    }

    /**
     * Получить данные для графика
     *
     * @return JsonResponse
     */
    public function getChartData(): JsonResponse
    {
        return response()->json(BetCurrency::geHistoricalBtcRates());
    }

    /**
     * Получить курс валют
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getExchangeRate(Request $request): JsonResponse
    {
        if (!is_array($request->get('codes'))) {
            throw new \Exception('Invalid request data');
        }

        $codes = [];

        foreach ($request->get('codes') as $code) {
            $codes[$code] = BetCurrency::getExchangeRate($code);
        }

        return response()->json($codes);
    }

    /**
     * Сделать ставку
     *
     * @param MakeBet $request
     * @return JsonResponse
     * @throws \Throwable
     * @see MakeBet
     */
    public function makeBet(MakeBet $request): JsonResponse
    {
        $bet = null;

        DB::transaction(function () use (&$bet, $request) {
            $authUser = Auth::user();
            $requestData = $request->all();

            $betData = [
                'user_id' => $authUser->id,
                'currency_id' => BetCurrency::BTC,
                'direction' => $requestData['direction'],
                'amount_usd' => $requestData['amount'],
                'commission_for_opening' => Bet::BET_OPENING_COMMISSION,
                'exchange_rate_at_opening' => BetCurrency::getBtcRate(),
                'duration' => Carbon::create(null, null, null, 0, $requestData['duration'], 0),
                'opened_at' => now(config('graybull.timezone')),
                'closing_at' => now(config('graybull.timezone'))->addMinutes($requestData['duration']),
            ];

            if ($requestData['balance'] !== 'usd') {
                $betData['amount_' . $requestData['balance']] = $requestData['final_currency_amount'];
            }

            $bet = Bet::create($betData);

            UserService::debitingUserFunds($authUser, $requestData['balance'], $requestData['final_currency_amount']);
        });

        /**
         * Для работы с ожидаемым форматом данных из базы
         *
         * @see Bet::getDurationInMinutesAttribute()
         */
        $bet->refresh();

        /**
         * Для обновления баланса
         */
        Auth::user()->refresh();

        $historicalBtcRates = BetCurrency::geHistoricalBtcRates();

        return response()->json([
            'bet' => $bet,
            'user_data' => $this->getUserData()->getData(true),
            'bet_point' => end($historicalBtcRates)[0],
        ]);
    }

    /**
     * Закрыть ставку
     *
     * @param CloseBet $request
     * @return JsonResponse
     * @throws \Modules\Graybull\Exceptions\BetIsNotActiveException
     * @throws \Throwable
     */
    public function closeActiveBet(CloseBet $request): JsonResponse
    {
        /** @var Bet $bet */
        $bet = Bet::findOrFail($request->post('bet_id'));

        /**
         * Ставка может быть закрыта кроном на доли секунды раньше,
         * чем дойдет запрос
         */

        if ($bet->isActive()) {
            $bet->closeBet();
        }

        /**
         * Для обновления баланса
         */
        Auth::user()->refresh();

        return response()->json([
            'bet_payment' => $bet->payment,
            'user_data' => $this->getUserData()->getData(true),
        ]);
    }
}
