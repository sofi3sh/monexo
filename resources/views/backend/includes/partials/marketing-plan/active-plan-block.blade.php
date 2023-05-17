@if(!is_null($user->getUserMarketingPlan()))
    <br><b>Блок с информацией по активному маркетинг-плану</b>
    <br>Маркетинговый план: {{ $user->getUserMarketingPlan()->marketing_plan_id }}
    <br>Начало действия: {{ $user->getUserMarketingPlan()->start_at }}
    <br>Инвестировано: ${{ $user->getUserMarketingPlan()->invested_usd }}
    <br>Полученная прибыль: ${{ $user->getUserMarketingPlan()->profit_usd }}
    <br>Прибыль по партнерской программе: ${{ $user->getUserMarketingPlan()->partner_profit_usd }}
    <br>Инвестировано в коин: ${{ $user->getUserMarketingPlan()->coin_usd }}
@endif