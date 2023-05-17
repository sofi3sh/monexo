{{-- Реферальная статистика --}}
<div class="base_wrapper main_wrapper main_ref_statistic">
    <h2 class="title">@lang('cabinet_refer.refer_statistic.title')</h2>
    <div class="statistic">
        <div class="block">
            <div class="logo">
                <img src="{{ asset('backend/production/img/icons/ref-stat-1.png') }}" alt="Agio Referrals Statistic">
            </div>
            <div class="data">
                <h4 class="title">@lang('cabinet_refer.refer_statistic.count')</h4>
                <strong class="num ref-num">0</strong>
            </div>
        </div>
        <div class="block">
            <div class="logo">
                <img src="{{ asset('backend/production/img/icons/ref-stat-2.png') }}" alt="Agio Referrals Statistic">
            </div>
            <div class="data">
                <h4 class="title">@lang('cabinet_refer.refer_statistic.income')</h4>
                <strong class="num sum">{{ number_format($user->referrals_usd, 2) }}$</strong>
            </div>
        </div>
        <div class="block">
            <div class="logo">
                <img src="{{ asset('backend/production/img/icons/ref-stat-3.png') }}" alt="Agio Referrals Statistic">
            </div>
            <div class="data">
                <h4 class="title">@lang('cabinet_refer.refer_statistic.invest')</h4>
                <strong class="num sum">{{ number_format($structure_investment , 2) }}$</strong>
            </div>
        </div>
    </div>
</div>