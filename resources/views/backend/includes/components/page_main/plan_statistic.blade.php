{{-- Статистика по маркетинговым планам --}}
<div class="main_wrapper main_statistic">
    <div class="header">
        <div class="block">
            <h3>@lang('cabinet_home.plan_statistic.title')</h3>

            <div class="gradient-circle">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="start_time">
            @if(!is_null($user->userMarketingPlan))
                <h5>@lang('cabinet_home.plan_statistic.plan_start')</h5>
                <strong>{{ $user->userMarketingPlan->start_at }}</strong>
            @else
                <h5>@lang('cabinet_home.plan_statistic.plan_not')</h5>
                <strong>-</strong>
            @endif
        </div>

        {{-- Закрытие плана --}}
        @if(!is_null($user->userMarketingPlan))
            <form action="{{ route('home.marketing-plans.close') }}" method="POST" class="base_form">
                @csrf
                <div class="control">
                    <button type="button" @if($user->minDurationDaysLeft() > 0) class="close_active_plan disabled" disabled @else class="confirm_btn_window close_active_plan"  @endif>@lang('cabinet_home.plan_statistic.plan_close_btn')</button>
                </div>

                <div class="confirm_window">
                    <div class="block">
                        <div class="image">
                            <img src="{{ asset('/backend/production/img/confirm_bg.png') }}" alt="Agio Company">
                        </div>
                        <div class="text">
                            <p>@lang('cabinet_home.plan_statistic.plan_close_title')</p>
                        </div>
                        <div class="control">
                            <button type="button" class="submit">@lang('cabinet_home.plan_statistic.plan_close_confirm')</button>
                            <button type="button" class="close">@lang('cabinet_home.plan_statistic.plan_close_cancel')</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
    <div class="data">
        @if(!is_null($user->userMarketingPlan))
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_invest')</p>
                <strong class="num">{{ $user->userMarketingPlan->invested_usd }}</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.all_income')</p>
                <strong class="num">{{ $user->userMarketingPlan->profit_usd + $user->userMarketingPlan->partner_profit_usd }}</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_income')</p>
                <strong class="num">{{ $user->userMarketingPlan->profit_usd }}</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_agio')</p>
                <strong class="num">{{ $user->userMarketingPlan->coin_usd }}</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_ref')</p>
                <strong class="num">{{ $user->userMarketingPlan->partner_profit_usd }}</strong>
            </div>
        @else
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_invest')</p>
                <strong class="num">0.00</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.all_income')</p>
                <strong class="num">0.00</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_income')</p>
                <strong class="num">0.00</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_agio')</p>
                <strong class="num">0.00</strong>
            </div>
            <div class="block">
                <p>@lang('cabinet_home.plan_statistic.num_ref')</p>
                <strong class="num">0.00</strong>
            </div>
        @endif
    </div>
</div>
