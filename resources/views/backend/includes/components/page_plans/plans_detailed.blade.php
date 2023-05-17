@foreach(json_decode($allPlans, true) as $plan)
    @if ($plan['id'] != 5)
        <div class="plan_block">
            <div class="header">
                {{-- Название --}}
                <div class="name">
                    <h2>{{ $plan['name'] }}</h2>
                </div>
                {{-- Сумма инвестиций --}}
                <div class="invest">
                    <p>@lang('cabinet_plans.plans_detailed.invest', ['min' => $plan['min_invest_sum'], 'max' => $plan['max_invest_sum']])</p>
                </div>
            </div>
            <div class="content">
                {{-- Партнерка #1 --}}
                <div class="block">
                    <div class="dot">
                        <span></span>
                    </div>
                    <div class="data">
                        <div class="title">
                            <h4>@lang('cabinet_plans.plans_detailed.partner_title')</h4>
                        </div>
                        <div class="text">
                            @if ($plan['id'] == 1)
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '1', 'percent' => '15'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '2', 'percent' => '10'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line_dbl', ['first_line' => '3', 'last_line' => '7', 'percent' => '3'])</span>
                            @elseif ($plan['id'] == 2)
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '1', 'percent' => '30'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '2', 'percent' => '15'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line_dbl', ['first_line' => '3', 'last_line' => '10', 'percent' => '4'])</span>
                            @elseif ($plan['id'] == 3)
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '1', 'percent' => '35'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '2', 'percent' => '20'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line_dbl', ['first_line' => '3', 'last_line' => '15', 'percent' => '2'])</span>
                            @elseif ($plan['id'] == 4)
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '1', 'percent' => '40'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '2', 'percent' => '15'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line_dbl', ['first_line' => '3', 'last_line' => '20', 'percent' => '2'])</span>
                            @else
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '1', 'percent' => '0'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line', ['line' => '2', 'percent' => '0'])</span>
                                <span>@lang('cabinet_plans.plans_detailed.partner_line_dbl', ['first_line' => '3', 'last_line' => '20', 'percent' => '0'])</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Срок работы депа --}}
                <div class="block">
                    <div class="dot">
                        <span></span>
                    </div>
                    <div class="data">
                        <div class="title">
                            <h4>@lang('cabinet_plans.plans_detailed.income_title')</h4>
                        </div>
                        <div class="text">
                            @if ($plan['id'] == 4)
                                <span>@lang('cabinet_plans.plans_detailed.income_day_inf')</span>
                            @else
                                <span>@lang('cabinet_plans.plans_detailed.income_day', ['min_day' => $plan['min_duration'], 'max_day' => $plan['max_duration']])</span>
                            @endif
                            {{-- Условие на недельные начисления --}}
                            @if ($plan['only_business_days'] == 1)
                                <span>@lang('cabinet_plans.plans_detailed.income_1')</span>
                            @else
                                <span>@lang('cabinet_plans.plans_detailed.income_2')</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Доходность --}}
                <div class="block">
                    <div class="dot">
                        <span></span>
                    </div>
                    <div class="data">
                        <div class="title">
                            <h4>@lang('cabinet_plans.plans_detailed.profit_title')</h4>
                        </div>
                        <div class="text">
                            @if ($plan['id'] == 1)
                                <span>@lang('cabinet_plans.plans_detailed.profit_sum', ['min_profit' => '0.9', 'max_profit' => '2.2'])</span>
                            @elseif ($plan['id'] == 2)
                                <span>@lang('cabinet_plans.plans_detailed.profit_sum', ['min_profit' => '1.3', 'max_profit' => '2.5'])</span>
                            @elseif ($plan['id'] == 3)
                                <span>@lang('cabinet_plans.plans_detailed.profit_sum', ['min_profit' => '1.6', 'max_profit' => '2.8'])</span>
                            @elseif ($plan['id'] == 4)
                                <span>@lang('cabinet_plans.plans_detailed.profit_sum', ['min_profit' => '1.85', 'max_profit' => '3'])</span>
                            @else
                                <span>@lang('cabinet_plans.plans_detailed.profit_sum', ['min_profit' => $plan['min_profit'], 'max_profit' => $plan['max_profit']])</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Вывод --}}
                <div class="block">
                    <div class="dot">
                        <span></span>
                    </div>
                    <div class="data">
                        <div class="title">
                            <h4>@lang('cabinet_plans.plans_detailed.withdrawal_title')</h4>
                        </div>
                        <div class="text">
                            <span>@lang('cabinet_plans.plans_detailed.withdrawal_sum', ['min' => $plan['min_withdrawal_request']])</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach