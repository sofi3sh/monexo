{{-- Реферальные таблицы --}}
<div class="tabs_header">
    <button class="tabs_btn active" data-content="my_referrals">@lang('cabinet_refer.table.tab_1')</button>
    <div class="base_select">
        <div class="elements_selected">
            <div class="block active">
                <p class="text">1 @lang('cabinet_refer.table.level')</p>
            </div>
        </div>
        <small class="arrow">
            @include('backend.includes.partials.svg.user_arrow')
        </small>
        <div class="elements_list">
            {{-- Если у пользователя нет рефералов --}}
            @if(empty($referrals[0]))
                <div class="block">
                    <p class="text">1 @lang('cabinet_refer.table.level')</p>
                </div>
            @else
                @foreach($referrals as $referralsOnLevel)
                    <div class="block">
                        <p class="text">{{ $loop->iteration }} @lang('cabinet_refer.table.level')</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="tabs_content">
    {{-- Если у пользователя нет рефералов --}}
    @if(empty($referrals[0]))
        {{-- Пустышка --}}
        <div class="content my_referrals my_ref_1 active">
            <div class="base-table base-table_wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="ref_email">@lang('cabinet_refer.table.email')</th>
                            <th class="ref_balance">@lang('cabinet_refer.table.invest')</th>
                            <th class="ref_profit">@lang('cabinet_refer.table.income')</th>
                            <th class="ref_with">@lang('cabinet_refer.table.withdrawal')</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        {{-- Цикл по рефералам --}}
        @foreach($referrals as $referralsOnLevel)
            <div class="content my_referrals my_ref_{{ $loop->iteration }} @if($loop->iteration == 1) active @endif" data-ref-count="0">
                <div class="base-table base-table_wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="ref_email">@lang('cabinet_refer.table.email')</th>
                                <th class="ref_balance">@lang('cabinet_refer.table.invest')</th>
                                <th class="ref_profit">@lang('cabinet_refer.table.income')</th>
                                <th class="ref_with">@lang('cabinet_refer.table.withdrawal')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referralsOnLevel[0] as $referral)
                                <tr>
                                    {{-- Почта --}}
                                    <td class="ref_email" aria-label="@lang('cabinet_refer.table.email')">
                                        <span>{{ $referral->email }}</span>
                                    </td>

                                    {{-- Сумма инвестированная в маркетинг --}}
                                    <td class="ref_balance" aria-label="@lang('cabinet_refer.table.invest')">
                                        <span>${{ is_null($referral->getUserMarketingPlan()) ? '0.00' : number_format($referral->getUserMarketingPlan()->invested_usd, 2) }}</span>
                                    </td>

                                    {{-- Доxод партнера --}}
                                    <td class="ref_profit" aria-label="@lang('cabinet_refer.table.income')">
                                        <span>${{ $referral->profit_usd }}</span>
                                    </td>

                                    {{-- Сколько вывел мой партнер --}}
                                    <td class="ref_with" aria-label="@lang('cabinet_refer.table.withdrawal')">
                                        <span>${{ $referral->withdrawal_usd }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>