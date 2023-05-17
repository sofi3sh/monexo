{{-- Калькулятор для планов --}}
<div class="content">
    <div class="data">
        <div class="calculator MainPlanCalculator">
            <div class="base_title">
                <h2>@lang('cabinet_plans.calculator.title')</h2>
                <small>@lang('cabinet_plans.calculator.sub_title')</small>
            </div>

            {{-- Поля для ввода данных и выбора плана --}}
            <div class="data_inputs">
                {{-- Выбор плана --}}
                <div class="block">
                    <label for="calculator__active_plan">@lang('cabinet_plans.calculator.select_plan')</label>
                    <select name="calculator__active_plan" id="calculator__active_plan" class="plans_list">
                        @foreach(json_decode($allPlans, true) as $plan)
                            @if ($plan['id'] != 5)
                                <option value="{{ $loop->iteration }}"
                                        data-lastDay="{{ $plan['max_duration'] }}" 
                                        @if ($plan['id'] == 1)
                                            data-firstPercent="10.5" 
                                            data-lastPercent="10.5"
                                        @elseif ($plan['id'] == 2)
                                            data-firstPercent="3.7" 
                                            data-lastPercent="3.7"
                                        @elseif ($plan['id'] == 3)
                                            data-firstPercent="2.0" 
                                            data-lastPercent="2.0"
                                        @elseif ($plan['id'] == 4)
                                            data-firstPercent="1.4" 
                                            data-lastPercent="1.4"
                                        @else
                                            data-firstPercent="{{ $plan['min_profit'] }}" 
                                            data-lastPercent="{{ $plan['max_profit'] }}" 
                                        @endif
                                        data-minSum="{{ $plan['min_invest_sum'] }}" 
                                        data-maxSum="{{ $plan['max_invest_sum'] }}"
                                        >
                                    {{ $plan['name'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Сумма депозита --}}
                <div class="block">
                    <label for="calculator__invested_sum">@lang('cabinet_plans.calculator.invest_plan')</label>
                    <input class="calculator__invested_sum" type="number" name="calculator__invested_sum" id="calculator__invested_sum" min="0" max="499" step="0.1" val="0">
                </div>
            </div>

            {{-- Минимальная и максимальная сумма вклада --}}
            <div class="data_sum">
                <small class="invest_sum">@lang('cabinet_plans.calculator.min_invest', ['sum' => '0.00'])</small>
                <small class="invest_sum">@lang('cabinet_plans.calculator.max_invest', ['sum' => '0.00'])</small>
            </div>

            {{-- Бегунок для выбора активных дней --}}
            <div class="data_tape">
                <label for="calculator__day_tape">@lang('cabinet_plans.calculator.days_plan')</label>
                <input type="range" class="day_tape" name="calculator__day_tape" id="calculator__day_tape" value="1" min="1" max="100" step="1">
                <small class="first_day" data-word="@lang('cabinet_plans.calculator.days')">0 @lang('cabinet_plans.calculator.days')</small>
                <small class="last_day" data-word="@lang('cabinet_plans.calculator.days')">0 @lang('cabinet_plans.calculator.days')</small>
            </div>

            {{-- Полученные данные --}}
            <div class="data_user_get">
                <div class="block days">
                    <small>@lang('cabinet_plans.calculator.days_full')</small>
                    <h4>0</h4>
                </div>
                <div class="block income">
                    <small>@lang('cabinet_plans.calculator.income')</small>
                    <h4>0</h4>
                </div>
            </div>
        </div>
        <div class="image">
            <img src="{{ asset('backend/production/img/calc_add_obj.png') }}" alt="Agio Company" class="add_obj">
            <img src="{{ asset('backend/production/img/main_calculator.png') }}" alt="Agio Company">
        </div>
    </div>
</div>