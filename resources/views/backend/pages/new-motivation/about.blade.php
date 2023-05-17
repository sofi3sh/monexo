@extends('layouts.app')

@section('content')
    @include('includes.partials.messages')

    {{-- Content wrapper --}}
    <div class="wrapper--offers">

    @foreach($plans as $plan)
        {{-- Offer block --}}
        <div @if($loop->index == 0)
               class="offer-block active"
             @else
               class="offer-block"
             @endif>

            {{-- Offer block control & title --}}
            <div class="ob-control">
                
                {{-- Title --}}
                <h3 class="ob-control--title">{{ __('cabinet.motivation.title') }}</h3>

                <div class="ob-control--wrapper">

                    {{-- Up button --}}
                    <button class="ob-control--button up">
                        <span></span>
                        <span></span>
                    </button>  

                    {{-- Plan name --}}
                    <div class="ob-control--item">
                        <h1>{{ $plan->name }}</h1>
                    </div>

                    {{-- Down button --}}
                    <button class="ob-control--button down">
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>

            {{-- Offer block content --}}
            <div class="ob-content">

                {{-- First block --}}
                <div class="ob-header">

                    {{-- Content --}}
                    <div class="ob-header--left">
                        <div class="ob-header--left-item">
                            <p>{{ __('cabinet.motivation.income') }}</p>
                            <p>
                                @if ($loop->index == 0)
                                    @lang('cabinet.motivation.income-sum', ['first' => $plan->min_invest_sum, 'second' => '3500'])
                                    @elseif ($loop->index == 1)
                                        @lang('cabinet.motivation.income-sum', ['first' => $plan->min_invest_sum, 'second' => '25000'])
                                    @elseif ($loop->index == 2)
                                        @lang('cabinet.motivation.income-sum', ['first' => $plan->min_invest_sum, 'second' => '75000'])
                                    @elseif ($loop->index == 3)
                                        @lang('cabinet.motivation.income-sum', ['first' => $plan->min_invest_sum, 'second' => '2 000 000'])
                                @endif
                            </p>
                        </div>
                        <div class="ob-header--left-item">
                            <p>{{ __('cabinet.motivation.price') }}</p>
                            <p>${{ $plan->price }}</p>
                        </div>
                        <div class="ob-header--left-item">
                            <p>{{ __('cabinet.motivation.min-with') }}</p>
                            <p>${{ $plan->min_withdrawal }}</p>
                        </div>
                        <div class="ob-header--left-item">
                            <p>{{ __('cabinet.motivation.pers-cons') }}</p>
                            <p>{{ __('cabinet.motivation.yes') }}</p>
                        </div>
                        <div class="ob-header--left-item">
                            <p>{{ __('cabinet.motivation.open-off') }}</p>
                            <p>
                                @if ($loop->index == 0)
                                {{ __('cabinet.motivation.open-off-rl') }}
                                @elseif ($loop->index >= 1 && $loop->index <= 3)
                                    {{ __('cabinet.motivation.yes') }}
                                @endif
                            </p>
                        </div>
                        <div class="ob-header--left-item">
                            <p>{{ __('cabinet.motivation.pers-www') }}</p>
                            <p>
                                @if ($loop->index == 2 && $loop->index == 3)
                                    {{ __('cabinet.motivation.yes') }}
                                @else
                                    {{ __('cabinet.motivation.no') }}
                                @endif
                            </p>
                        </div>
                        <div class="ob-header--left-item">
                            <p>{{ __('cabinet.motivation.online-off') }}</p>
                            <p>
                                @if ($loop->index == 2 && $loop->index == 3)
                                    {{ __('cabinet.motivation.yes') }}
                                @else
                                    {{ __('cabinet.motivation.no') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Buy button --}}
                    @if(is_null($user->motivation_plan_id))
                        <form class="ob-header--form" action="{{ route('home.new-motivation.buy', $plan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="ob-header--right">
                                <h2>{{ __('cabinet.motivation.start') }}</h2>
                            </button>
                        </form>
                    @elseif($plan->id == $user->motivation_plan_id)
                        <div class="ob-header--right">
                            <h2>{{ __('cabinet.motivation.active') }}</h2>
                        </div>
                    @elseif($plan->id != $user->motivation_plan_id)
                        <div class="ob-header--right">
                            <h2>{{ __('cabinet.motivation.has-plan') }}</h2>
                        </div>
                    @endif

                </div>

                {{-- Second block --}}
                <div class="ob-footer">
                    <div class="month-tape"></div>

                    {{-- Month block --}}
                    @foreach($plan->params as $param)
                        <div class="ob-footer__card">

                            {{-- Month --}}
                            <div class="month">
                                <small>{{ $param->month_number }}</small>
                            </div>

                            {{-- Title --}}
                            <div class="title">{{ __('cabinet.motivation.month') }}</div>

                            {{-- Content --}}
                            <div class="content">
                                <p>@lang('cabinet.motivation.profit-dep', ['dep-sum' => $param->deposit_profit_bonus_percent ])</p>
                                <p>@lang('cabinet.motivation.profit-ref', ['ref-sum' => $param->referrals_profit_bonus_percent ])</p>

                                {{-- Content --}}
                                @switch($loop->parent->index)
                                    @case(0)
                                        @switch($loop->index)
                                            @case(0)
                                                <p>@lang('cabinet.motivation.withdrawal', ['withdrawal' => $param->withdrawal_commission])</p>
                                                @break
                                            @case(1)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '3000', 'com' => '9'])</p>
                                                @break
                                            @case(2)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '10 000', 'com' => '8.5'])</p>
                                                @break
                                            @case(3)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '20 000', 'com' => '7.5'])</p>
                                                @break
                                        @endswitch
                                        @break
                                    @case(1)
                                        @switch($loop->index)
                                            @case(0)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '30 000', 'com' => '6.55'])</p>
                                                @break
                                            @case(1)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '50 000', 'com' => '6'])</p>
                                                @break
                                            @case(2)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '80 000', 'com' => '5.5'])</p>
                                                @break
                                            @case(3)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '150 000', 'com' => '5.5'])</p>
                                                @break
                                        @endswitch
                                        @break
                                    @case(2)
                                        @switch($loop->index)
                                            @case(0)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '100 000', 'com' => '5.5'])</p>
                                                @break
                                            @case(1)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '200 000', 'com' => '5'])</p>
                                                @break
                                            @case(2)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '300 000', 'com' => '4.75'])</p>
                                                @break
                                            @case(3)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '500 000', 'com' => '4.7'])</p>
                                                @break
                                        @endswitch
                                        @break
                                    @case(3)
                                        @switch($loop->index)
                                            @case(0)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '150 000', 'com' => '5.2'])</p>
                                                @break
                                            @case(1)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '500 000', 'com' => '4.25'])</p>
                                                @break
                                            @case(2)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '700 000', 'com' => '4.05'])</p>
                                                @break
                                            @case(3)
                                                <p>@lang('cabinet.motivation.refinan-hig', ['sum' => '1 000 000', 'com' => '4'])</p>
                                                @break
                                        @endswitch
                                        @break
                                @endswitch
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    @endforeach

    </div>
    {{-- Content end --}}

@endsection