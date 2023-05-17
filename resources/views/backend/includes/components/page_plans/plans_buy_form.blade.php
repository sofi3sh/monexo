{{-- Покупка маркетингового плана --}}
<div class="main_wrapper main_buy_plan">
    <form action="{{ route('home.marketing-plans.buy') }}" method="POST" class="base_form">
        @csrf
        <h2 class="title">@lang('cabinet_plans.buy_form.title')</h2>
        {{-- <small class="sub-title">@lang('cabinet_plans.buy_form.sub_title')</small> --}}

        {{-- Сумма вклада --}}
        <div class="block">
            <label for="invested_usd">@lang('cabinet_plans.buy_form.amount')</label>
            <input type="number" value="{{ old('invested_usd') }}" id="user_card" name="invested_usd" min="1" required>
            <small class="input-ending">USD</small>
        </div>
        
        <div class="block">
            <label for="base_select">@lang('cabinet_plans.buy_form.system')</label>
            <div class="base_select">
                <div class="elements_selected">
                    <div class="block active">
                        <div class="logo">
                            <img src="{{ asset('backend/production/img/icons/agio_plans.png') }}" alt="Agio Withdrawals">
                        </div>
                        <p class="text">Advertising</p>
                    </div>
                </div>
                <small class="arrow">
                    @include('backend.includes.partials.svg.user_arrow')
                </small>
                <div class="elements_list">
                    @foreach(json_decode($plans, true) as $plan)
                        <div class="block" data-id="{{ $plan['id'] }}" data-max-sum="{{ $plan['min_invest_sum'] }}" data-min-sum="{{ $plan['max_invest_sum'] }}" @if(!is_null($user->userMarketingPlan)) data-user-sum="{{ $user->userMarketingPlan->invested_usd }}" @else data-user-sum="0" @endif>
                            <div class="logo">
                                <img src="{{ asset('backend/production/img/icons/agio_plans.png') }}" alt="Agio Withdrawals">
                            </div>
                            <p class="text">{{ $plan['name'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <select name="marketing_plan_id" id="plans__select_plan" {{-- class="selected_area" --}} hidden>
                @foreach(json_decode($plans, true) as $plan)
                    <option value="{{ $plan['id'] }}" {{ (old("marketing_plan_id") == $plan['id'] ? "selected":"") }}>{{ $plan['name'] }}</option>
                @endforeach
            </select>

            <div class="sub_info min_sum_info">@lang('cabinet_plans.buy_form.min_sum') $<small class="num">50</small></div>
            <div class="sub_info max_sum_info">@lang('cabinet_plans.buy_form.max_sum') $<small class="num">499</small></div>
        </div>

        @include('includes.partials.messages')

        <div class="control">
            <p class="info">@lang('cabinet_plans.buy_form.info')</p>
            <button>@lang('cabinet_plans.buy_form.button')</button>
        </div>

    </form>
</div>