{{-- Статистика по всем типам баланса --}}
<div class="main_wrapper main_user_data">
    <div class="header">
        <div class="data">
            <div class="balance">
                <h3>@lang('cabinet_home.money_statistic.stat_main')</h3>
                <strong class="num">{{ number_format($user->balance_usd, 0) }}</strong>
                <small class="currency">USD</small>
                
                <div class="icon">
                    @include('backend.includes.partials.svg.page_main.stat_main')
                </div>
                <div class="gradient-circle">
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a href="{{ route('home.invest') }}" class="link">@lang('cabinet_home.money_statistic.link')</a>
        </div>
    </div>
    <div class="another">
        <h3 class="title">@lang('cabinet_home.money_statistic.title')</h3>
        <div class="block">
            <div class="balance">
                <h3>@lang('cabinet_home.money_statistic.stat_income')</h3>
                <strong class="num">{{ number_format($user->profit_usd - $user->referrals_usd, 0) }}</strong>
                {{-- <strong class="num">{{ number_format($user->profit_usd, 0) }}</strong> --}}
                <small class="currency">USD</small>
                
                <div class="icon">
                    @include('backend.includes.partials.svg.page_main.stat_coins')
                </div>
            </div>
            <div class="gradient-circle">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="block">
            <div class="balance">
                <h3>@lang('cabinet_home.money_statistic.stat_invest')</h3>
                <strong class="num">{{ number_format($user->invested_usd, 0) }}</strong>
                <small class="currency">USD</small>
                
                <div class="icon">
                    @include('backend.includes.partials.svg.page_main.stat_payment')
                </div>
            </div>
            <div class="gradient-circle">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="block">
            <div class="balance">
                <h3>@lang('cabinet_home.money_statistic.stat_refer')</h3>
                <strong class="num">{{ number_format($user->referrals_usd, 0) }}</strong>
                <small class="currency">USD</small>
                
                <div class="icon">
                    @include('backend.includes.partials.svg.page_main.stat_refer')
                </div>
            </div>
            <div class="gradient-circle">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="block">
            <div class="balance">
                <h3>Agio Token</h3>
                <strong class="num">{{ number_format($user->getBalance(2, 1), 0) }}</strong>
                <small class="currency">USD</small>
                
                <div class="icon">
                    @include('backend.includes.partials.svg.page_main.stat_agio')
                </div>
            </div>
            <div class="gradient-circle">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="block">
            <div class="balance">
                <h3>@lang('cabinet_home.money_statistic.stat_bonus')</h3>
                <strong class="num">{{ number_format($user->bonuses_usd, 0) }}</strong>
                <small class="currency">USD</small>
                
                <div class="icon">
                    @include('backend.includes.partials.svg.page_main.stat_bonus')
                </div>
            </div>
            <div class="gradient-circle">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="block">
            <div class="balance">
                <h3>@lang('cabinet_home.money_statistic.stat_withdrawal')</h3>
                <strong class="num">{{  number_format($user->withdrawal_usd, 0) }}</strong>
                <small class="currency">USD</small>
                
                <div class="icon">
                    @include('backend.includes.partials.svg.page_main.stat_hand')
                </div>
            </div>
            <div class="gradient-circle">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</div>