

@lang('debts-info.user', ['name' => Auth::user()->name ])
@lang('debts-info.pre-info')

<ol>
    {{-- Название открытого пакета - условия пакета --}}
    @foreach ($oldOpenPackages as $ump)
        @php $mp = $ump->MarketingPlan @endphp
        <li>
            @lang('debts-info.package-info',[
                'name' =>  $mp->name,
                'body_on' => $mp->body_on ? trans('debts-info.helpers.body_on.on') : trans('debts-info.helpers.body_on.off'),
                'accrual' => $mp->accrual_period === 7 ? trans('debts-info.helpers.accrual.week') : trans('debts-info.helpers.accrual.day')
            ])
            @if ($mp->daily_percent > 0)
                {{ $mp->daily_percent }}%
            @else
                @lang('debts-info.percent-min-max', [
                'min' => $mp->min_profit,
                'max' => $mp->max_profit
                ])
            @endif
        </li>
    @endforeach
    <li>@lang('debts-info.balance', [
        'balance' => "$$oldBalance"
    ])</li>
</ol>

<p>@lang('debts-info.for-calc')</p>

<ol>
    @foreach ($oldOpenPackages as $ump)
        @php $mp = $ump->MarketingPlan @endphp
        @if ($ump->invested_usd > 0)
            @php 
                $balanceOfCharges = floor($ump->days_left / $mp->accrual_period);
                $balanceOfCharges = $balanceOfCharges === ($ump->days_left / $mp->accrual_period) ? $balanceOfCharges | $balanceOfCharges + 1;
            @endphp

            <li>
                <p>@lang('debts-info.package-logic', ['name' => $mp->name])</p>
                
                @if ($mp->daily_percent > 0)
                    
                    @lang('debts-info.package-dayli-percent', [
                      'balanceOfCharges' => $balanceOfCharges,
                      'daily_percent' => $mp->daily_percent,
                      'invest' => $ump->invested_usd,
                    ])
                    @if (!$mp->body_on)
                        @lang('debts-info.invest-sum', [
                            'invest' => $ump->invested_usd
                        ])
                    @endif.

                    @lang('debts-info.package-total', [
                        'total' => $balanceOfCharges * $mp->daily_percent * $ump->invested_usd  + (!$mp->body_on ? $ump->invested_usd : 0)
                    ])
                @else
                
                    @php $percent =  ($mp->min_profit + $mp->max_profit) / 2 @endphp

                    @lang('debts-info.middle-percent', [
                        'balanceOfCharges' => $balanceOfCharges,
                        'min_profit' => $mp->min_profit,
                        'max_profit' => $mp->max_profit
                    ])

                    @if (!$mp->body_on)
                        @lang('debts-info.invest-sum', [
                            'invest' => $ump->invested_usd
                        ])
                    @endif.
                    
                    @lang('debts-info.package-total', [
                        'total' => $balanceOfCharges * $percent * $ump->invested_usd + (!$mp->body_on ? $ump->invested_usd : 0)
                    ])
                @endif
            </li>
        @endif
    @endforeach
</ol>

<p>
    @lang('debts-info.packages-total', ['total' => Auth::user()->debt_usd_fixed - $oldBalance])
</p>

<p>@lang('debts-info.debts-usd-info', ['debt_usd_fixed' => Auth::user()->debt_usd_fixed])</p>

<p>@lang('debts-info.statistics.title')</p>

<p>@lang('debts-info.statistics.replenishment.title')</p>

<ul>
    @foreach ($transactionStatistic as $info)
        @if ($info->transaction_type_id === 1)
            <li>
                @lang('debts-info.statistics.replenishment.package-info', [
                    'date' => Illuminate\Support\Carbon::parse($info->created_at)->format('d.m.Y h:i:s'),
                    'sum' => $info->amount_usd > 0 ? $info->amount_usd : $info->amount_usd * -1
                ])
            </li>
        @endif
    @endforeach
</ul>

<p>@lang('debts-info.statistics.withdrawal.title')</p>

<ul>
    @foreach ($transactionStatistic as $info)
        @if ($info->transaction_type_id === 14)
            <li>
                @lang('debts-info.statistics.withdrawal.package-info', [
                    'date' => Illuminate\Support\Carbon::parse($info->created_at)->format('d.m.Y h:i:s'),
                    'sum' => $info->amount_usd > 0 ? $info->amount_usd : $info->amount_usd * -1
                ])
            </li>
        @endif
    @endforeach
</ul>


<p>
    @lang('debts-info.more-info', [
        'href' => route('home.profile.profile')
    ])
</p>
