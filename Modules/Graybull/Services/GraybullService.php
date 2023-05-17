<?php

namespace Modules\Graybull\Services;

use Modules\Graybull\Models\Bet;

class GraybullService
{
    /**
     * Закрыть, готовые к закрытию, ставки
     */
    public static function controlBets(): void
    {
        Bet::readyToClose()
            ->with('user')
            ->each(function (Bet $bet) {
                $bet->closeBet();
            });
    }

    /**
     * Закрыть, готовую к закрытию, ставку пользователя
     *
     * @throws \Modules\Graybull\Exceptions\BetIsNotActiveException
     * @throws \Throwable
     */
    public static function controlUserActiveBet(): void
    {
        /** @var Bet $activeBet */
        $activeBet = Bet::readyToClose()
            ->where('user_id', auth()->id())
            ->first();

        optional($activeBet)->closeBet();
    }
}
