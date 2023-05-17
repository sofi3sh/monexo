{{-- Блок с маркетинг планами --}}
<div class="main_wrapper main_plan">
    <div class="all_slides">
        @foreach(json_decode($allPlans, true) as $plan)
            <div class="slide @if($loop->first) active @endif">
                <div class="zone text">

                    {{-- Название плана --}}
                    <div class="name">
                        <h2>{{ $plan['name'] }}</h2>
                    </div>
                    
                    {{-- Пределы инвестиции в план --}}
                    <div class="invest">
                        <p>@lang('cabinet_home.plan_slider.invest', ['min' => $plan['min_invest_sum'], 'max' => $plan['max_invest_sum']])</p>
                    </div>
                    
                    {{-- Ссылка на страницу с планами (Скрыто на странцие с планами) --}}
                    <div class="control">
                        <p>@lang('cabinet_home.plan_slider.text_' . $plan['id'] . '')</p>
                        @if(!isActive('home.marketing-plans.index'))
                            <a href="{{ route('home.marketing-plans.index') }}">@lang('cabinet_home.plan_slider.link_more')</a>
                        @endif
                    </div>

                </div>
                <div class="zone data">
                    <div class="block">
                        <div class="logo">
                            @include('backend.includes.partials.svg.page_main.time')
                        </div>
                        @if ($plan['id'] == 4 || $plan['id'] == 5)
                            <p>@lang('cabinet_home.plan_slider.plan_duration_inf')</p>
                        @else
                            <p>@lang('cabinet_home.plan_slider.plan_duration', ['min' => $plan['min_duration'], 'max' => $plan['max_duration']])</p>
                        @endif
                    </div>
                    <div class="separator">
                        <span></span>
                    </div>
                    <div class="block">
                        <div class="logo">
                            @include('backend.includes.partials.svg.page_main.discount')
                        </div>
                        @if ($plan['id'] == 1)
                            <p>@lang('cabinet_home.plan_slider.plan_income', ['min' => $plan['min_profit'], 'max' => '2.2'])</p>
                        @elseif ($plan['id'] == 2)
                            <p>@lang('cabinet_home.plan_slider.plan_income', ['min' => $plan['min_profit'], 'max' => '2.5'])</p>
                        @elseif ($plan['id'] == 3)
                            <p>@lang('cabinet_home.plan_slider.plan_income', ['min' => '1.6', 'max' => '2.8'])</p>
                        @elseif ($plan['id'] == 4)
                            <p>@lang('cabinet_home.plan_slider.plan_income', ['min' => '1.85', 'max' => '3'])</p>
                        @elseif ($plan['id'] == 5)
                            <p>@lang('cabinet_home.plan_slider.plan_income_inf')</p>
                        @else
                            <p>@lang('cabinet_home.plan_slider.plan_income', ['min' => $plan['min_profit'], 'max' => $plan['max_profit']])</p>
                        @endif
                    </div>
                    <div class="separator">
                        <span></span>
                    </div>
                    <div class="block">
                        <div class="logo">
                            @include('backend.includes.partials.svg.page_main.money')
                        </div>
                        <p>@lang('cabinet_home.plan_slider.plan_agio', ['percent' => $plan['coin_percent']])</p>
                    </div>
                    <div class="separator"></div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="control_slide">
        <button class="prev">
            @include('backend.includes.partials.svg.page_main.prev')
        </button>
        <button class="next">
            @include('backend.includes.partials.svg.page_main.next')
        </button>
    </div>
</div>