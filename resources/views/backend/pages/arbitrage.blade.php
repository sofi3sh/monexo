@extends('layouts.app')

@section('content')
    @if($arbitrage_on_of)
        <div class="page-blog">
            <div class="row">
                <div class="col-12">
                    @include('includes.partials.messages')
                    @if(is_null($active_arbitrage))
                        <div class="arbitrage-contents">
                            <div class="ac-plans">
                                @foreach($arbitrage_trading_plans as $plan)
                                    <div    @if ($loop->index == 0)
                                                class="plan-card bronze"
                                            @elseif ($loop->index == 1)
                                                class="plan-card silver"
                                            @elseif ($loop->index == 2)
                                                class="plan-card gold" {{-- aria-label="{{ __('arbitrage.main.after.title') }}" --}}
                                            @endif>
                                        <div class="pc-logo">
                                            <span class="info">
                                                @if ($loop->index == 0)
                                                    <h2>Bronze</h2>
                                                    <small>mini</small>
                                                @elseif ($loop->index == 1)
                                                    <h2>Silver</h2>
                                                    <small>medium</small>
                                                @elseif ($loop->index == 2)
                                                    <h2>Gold</h2>
                                                    <small>Maximum</small>
                                                @endif
                                                <h3>{{ $plan->price }}</h3>
                                            </span>
                                            <span class="bg"></span>
                                        </div>
                                        <div class="pc-validity">
                                            <h3><span>{{ $plan->duration }}</span> {{ __('arbitrage.main.plans.days') }}</h3>
                                        </div>
                                        <div class="pc-buy">
                                            <form action="{{ route('home.buy-arbitrage', $plan->id ) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="price" value="{{ $plan->price }}"/>
                                                @if($plan->id !== $user->arbitrage_trading_plan_id && $plan->id > $user->arbitrage_trading_plan_id && $user->is_trading_account)
                                                    <button type="submit" class="buy">{{ __('arbitrage.main.plans.buy') }}</button>
                                                @elseif($plan->id == $user->arbitrage_trading_plan_id && $user->is_trading_account)
                                                    <div class="buy active">{{ __('arbitrage.main.plans.active') }}</div>
                                                @elseif($user->is_trading_account)
                                                    <div class="buy buy-noth" style="opacity: 0.5;">{{ __('arbitrage.main.plans.buy') }}</div>
                                                @else
                                                    <div class="buy buy-noth" style="opacity: 0.5;">{{ __('arbitrage.main.plans.buy') }}</div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="pc-restrictions">
                                            <h4 class="deal-count">
                                                <span>{{ __('arbitrage.main.plans.to') }}<strong>{{ $plan->max_operation_count }}</strong></span><br>
                                                @lang('arbitrage.main.plans.to-days')
                                            </h4>
                                            <span class="separator"></span>
                                            <h4 class="deal-val">
                                                <span>$<strong>{{ $plan->max_sum }}</strong></span><br>
                                                @lang('arbitrage.main.plans.max-deal')
                                            </h4>
                                        </div>

                                        <div class="pc-corners"></div>
                                        <div class="pc-bg">
                                            @if ($loop->index == 0)
                                                <img src="{{ asset('/backend/img/arbitrage/card-1-bg.jpg') }}" alt="">
                                            @elseif ($loop->index == 1)
                                                <img src="{{ asset('/backend/img/arbitrage/card-2-bg.jpg') }}" alt="">
                                            @elseif ($loop->index == 2)
                                                <img src="{{ asset('/backend/img/arbitrage/card-3-bg.jpg') }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="ac-about">
                                <div class="control-block about-arbitrage">
                                    <div class="cb-title cb-title-about">
                                        <h2>{{ __('arbitrage.main.terms-title') }}</h2>
                                    </div>
                                    <div class="cb-steps cb-steps-about">
                                        <p>{{ __('arbitrage.main.terms') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ac-control">
                                <div class="control-block open-deal">
                                    <div class="cb-title">
                                        <h2>{{ __('arbitrage.main.open-deals.title') }}</h2>
                                    </div>
                                    <div class="cb-steps">
                                        <p>{{ __('arbitrage.main.open-deals.info1') }}</p>
                                        <p>{{ __('arbitrage.main.open-deals.info2') }}</p>
                                        <p>{{ __('arbitrage.main.open-deals.info3') }}</p>
                                        <p>{{ __('arbitrage.main.open-deals.info4') }}</p>
                                    </div>
                                    <div class="cb-data">
                                        <div class="cbd-select">
                                            <div class="cbd-title">
                                                <h4>{{ __('arbitrage.main.open-deals.currency') }}:</h4>
                                            </div>
                                            <div class="select-selected">
                                                <input type="text" id="arbitrage-crypto" value="Bitcoin" readonly>
                                                <img src="{{ asset('/backend/img/arbitrage/ps-btc.png') }}">
                                                <span>&#8250;</span>
                                            </div>
                                            <div class="select-list">
                                                <div class="list-element">
                                                    <input type="text" id="arbitrage-crypto--btc" value="Bitcoin" readonly>
                                                    <img src="{{ asset('/backend/img/arbitrage/ps-btc.png') }}">
                                                </div>
                                                <div class="list-element">
                                                    <input type="text" id="arbitrage-crypto--eth" value="Ethereum" readonly>
                                                    <img src="{{ asset('/backend/img/arbitrage/ps-eth.png') }}">
                                                </div>
                                                <div class="list-element">
                                                    <input type="text" id="arbitrage-crypto--xrp" value="Ripple" readonly>
                                                    <img src="{{ asset('/backend/img/arbitrage/ps-xrp.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cbd-value">
                                            <label for="arbitrage-sum" class="cbd-title">
                                                <h4>{{ __('arbitrage.main.open-deals.sum') }}:</h4>
                                            </label>
                                                @if(!is_null($user->arbitrage_trading_plan_id))
                                                    <input type="number" id="arbitrage-sum" value="{{ old('amount_usd') }}" min="10" max="{{ $max_deals_sum }}" step="0.01">
                                                @else
                                                    <input type="number" id="arbitrage-sum" value="{{ old('amount_usd') }}" min="0" max="0" step="0" readonly style="opacity: 0.75;">
                                                @endif
                                        </div>
                                    </div>
                                    <div class="cb-form">
                                    <form class="container-fluid arbitrageOpenDeal" action="{{ route('home.create-arbitrage', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="check-sum">
                                                @if(!is_null($user->arbitrage_trading_plan_id))
                                                        <input type="number" name="amount_usd" value="0" min="10" max="{{ $max_deals_sum }}" step="0.01" id="formArbSum" hidden>
                                                @else
                                                    <input type="number" name="amount_usd" value="0" min="0" max="0" step="0" id="formArbSum" hidden>
                                                @endif
                                            </div>
                                            <div class="check-crypto">
                                                @foreach($arbitrage_trading_cryptocurrencies as $arbitrage_trading_cryptocurrency)
                                                    <input type="radio" name="currency" hidden
                                                        value="{&#34;id&#34;:&#34;{{ $arbitrage_trading_cryptocurrency->id }}&#34;,&#34;code&#34;:&#34;{{ $arbitrage_trading_cryptocurrency->code }}&#34;}"
                                                        @if ($loop->index == 0) checked="checked" id="check-bitcoin"
                                                        @elseif ($loop->index == 1) id="check-ethereum"
                                                        @elseif ($loop->index == 2) id="check-ripple"
                                                        @endif>
                                                @endforeach
                                            </div>
                                            @if($user->is_trading_account)
                                                <button type="button" {{ (is_null($active_arbitrage) && $user->availableArbitrageCount()>0) ? '' : 'disabled'  }} class="deal-start">
                                                    {{ __('arbitrage.main.open-deals.btn') }}
                                                </button>
                                            @else
                                                <button type="button" disabled class="deal-start">
                                                    {{ __('arbitrage.main.open-deals.btn') }}
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                                <div class="control-block account-data">
                                    <div class="cb-title">
                                        <h2>{{ __('arbitrage.main.statistic.title') }}</h2>
                                    </div>
                                    <div class="ad-plan-term">
                                        <h3>{{ __('arbitrage.main.statistic.day-plan') }}:</h3>
                                        @if(! is_null($user->arbitrage_trade_days_left))
                                            <small>{{ $user->arbitrage_trade_days_left }}</small>
                                        @else
                                            <small>0</small>
                                        @endif
                                    </div>
                                    <div class="ad-funds-available">
                                        <div class="fa-count">
                                            <input type="number" value="{{ $user->balance_usd }}" readonly>
                                        </div>
                                        <div class="fa-tip--main">
                                            <span>!</span>
                                            <p class="fa-tip--info">{{ __('arbitrage.main.statistic.tip') }}</p>
                                        </div>
                                    </div>
                                    <div class="ad-deals-counter">
                                        <div class="dc-title">
                                            <h5>{{ __('arbitrage.main.statistic.count') }}:</h5>
                                        </div>
                                        <div class="dc-result" id="dealsCounter" data-deal-count="{{ $user->availableArbitrageCount() }}"
                                            @if(!is_null($user->arbitrage_trading_plan_id))
                                                data-max-deal-count="{{ $max_deals_count }}"
                                            @else
                                                data-max-deal-count="0"
                                            @endif >
                                            <div class="counter">
                                                <div class="min">0</div>
                                                <div class="max">
                                                    @if(!is_null($user->arbitrage_trading_plan_id))
                                                        {{ $max_deals_count }}
                                                    @else
                                                        0
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="actual-count">
                                                <div class="actual">0</div>
                                            </div>
                                            <div class="tape">
                                                <div class="tape-bg-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ac-small-info">
                                <div class="exchange-status acsi-block">
                                    <div class="ac-title">
                                        <h2>{{ __('arbitrage.main.exchange.title') }}</h2>
                                    </div>
                                    <div class="es-exchanges">
                                        <div class="exch-block">
                                            <span class="status"></span>
                                            <h3>Bitfinex</h3>
                                        </div>
                                        <div class="exch-block">
                                            <span class="status"></span>
                                            <h3>Bittrex</h3>
                                        </div>
                                        <div class="exch-block">
                                            <span class="status"></span>
                                            <h3>Kraken</h3>
                                        </div>
                                        <div class="exch-block">
                                            <span class="status"></span>
                                            <h3>Bitstamp</h3>
                                        </div>
                                        <div class="exch-block">
                                            <span class="status"></span>
                                            <h3>Coinbase</h3>
                                        </div>
                                        <div class="exch-block">
                                            <span class="status"></span>
                                            <h3>PrimeXBT</h3>
                                        </div>
                                    </div>
                                </div>
                                {{-- Выводим результаты предыдущей сделки --}}
                                @if(!is_null($last_operation))
                                    @include('backend.includes.partials.arbitrage-result-small-block', ['active_arbitrage'=>$last_operation])
                                @else
                                    <div class="last-deal acsi-block">
                                        <div class="ld-title">
                                            <h2>{{ __('arbitrage.main.last-deal.title') }}</h2>
                                        </div>
                                        <div class="ld-content">
                                            <div class="ld-data">
                                                <div class="ld-data--info">
                                                    <h5>{{ __('arbitrage.main.last-deal.sum') }}:</h5>
                                                    <span>$0</span>
                                                </div>
                                                <div class="ld-data--info">
                                                    <h5>{{ __('arbitrage.main.last-deal.buy') }}:</h5>
                                                    <span>-</span>
                                                </div>
                                                <div class="ld-data--info">
                                                    <h5>{{ __('arbitrage.main.last-deal.sale') }}:</h5>
                                                    <span>-</span>
                                                </div>
                                                <div class="ld-data--info">
                                                    <h5>{{ __('arbitrage.main.last-deal.rate') }}:</h5>
                                                    <span>$0</span>
                                                </div>
                                                <div class="ld-data--info">
                                                    <h5>{{ __('arbitrage.main.last-deal.start') }}:</h5>
                                                    <span>-</span>
                                                </div>
                                                <div class="ld-data--info">
                                                    <h5>{{ __('arbitrage.main.last-deal.end') }}:</h5>
                                                    <span>-</span>
                                                </div>
                                            </div>
                                            <div class="ld-result-sum">
                                                <span></span>
                                                <h3 class="last-deal-sum">0</h3>
                                                <small>usd</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif(is_null($active_arbitrage->end)) {{-- Если есть активная арбитражная ставка --}}
                        <div class="timer-card">
                            <div class="tc-content">
                                <div class="tcc-title">
                                    <h3>@lang('arbitrage.timer.title')</h3>
                                </div>
                                <div class="tcc-info">
                                {{--<span><h4>{{ __('arbitrage.timer.info1') }}:</h4><p>{{ $active_arbitrage->start }}</p></span>--}}
                                    <span><h4>{{ __('arbitrage.timer.info2') }}:</h4><p>{{ $will_be_completed_at }}</p></span>
                                    <span><h4>{{ __('arbitrage.timer.info3') }}:</h4><p>${{ $active_arbitrage->amount_usd }}</p></span>
                                    <span><h4>{{ __('arbitrage.timer.info4') }}:</h4><p>{{ $active_arbitrage->amount_usd / $active_arbitrage->buy_rate . ' ' . $active_arbitrage->currency->code }}</p></span>
                                    <span><h4>{{ __('arbitrage.timer.info5') }}:</h4><p>{{ $active_arbitrage->buyCryptocurrencyExchange->name }}</p></span>
                                    <span><h4>{{ __('arbitrage.timer.info6') }}:</h4><p>${{ $active_arbitrage->buy_rate }}</p></span>
                                </div>
                                <div class="tcc-scanning">
                                    <div class="scanning-title">
                                        <div class="status online">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <h3>{{ __('arbitrage.timer.scan-exch') }}</h3>
                                    </div>
                                    <div class="scanning-content">
                                        <div class="sc-exchange">
                                            <div class="status online">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="exchange">
                                                Bitfinex
                                                <div class="load"></div>
                                                <div class="bg"></div>
                                            </div>
                                        </div>
                                        <div class="sc-exchange">
                                            <div class="status online">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="exchange">
                                                Bittrex
                                                <div class="load"></div>
                                                <div class="bg"></div>
                                            </div>
                                        </div>
                                        <div class="sc-exchange">
                                            <div class="status online">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="exchange">
                                                Kraken
                                                <div class="load"></div>
                                                <div class="bg"></div>
                                            </div>
                                        </div>
                                        <div class="sc-exchange">
                                            <div class="status online">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="exchange">
                                                Bitstamp
                                                <div class="load"></div>
                                                <div class="bg"></div>
                                            </div>
                                        </div>
                                        <div class="sc-exchange">
                                            <div class="status online">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="exchange">
                                                Coinbase
                                                <div class="load"></div>
                                                <div class="bg"></div>
                                            </div>
                                        </div>
                                        <div class="sc-exchange">
                                            <div class="status online">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="exchange">
                                                PrimeXBT
                                                <div class="load"></div>
                                                <div class="bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tc-wrapper">
                                <div class="tcw-times">
                                </div>
                            </div>
                        </div>
                    @elseif(!$is_result_shown) {{-- Если результат сработавшей ставки не отображался --}}
                        @include('backend.includes.partials.arbitrage-result-card')
                    @endif
                </div>
            </div>
        </div>
        </div>
    @else
        Арбитражная торговля временно приостановлена.
    @endif
@endsection

@section('scripts')
    <script>

        // Если есть активная ставка и НЕ отображение результатов
        if (("{{ $active_arbitrage }}" !== '') && ("{{ $is_result_shown }}" !== '')) {
            // Получаем значение с timestamp до которого будет открыта активная торговля
            var will_be_completed_at = "{{ $will_be_completed_at }}";
            // Время таймера
            var timeOut = Number("{{ $arbitrage_time }}");

            // Таймер счетчик
            var timerArbMinutes    = $('.tcw-times'),
                timerHeightMinutes = 0,
                timeChildrenCount  = 0,
                timeMinutes        = 0,
                timeSeconds        = 0;

            var dataLogsTime    = will_be_completed_at,
                dataLogsMinutes = Number(dataLogsTime.substr(-5, 2)),
                dataLogsSeconds = Number(dataLogsTime.substr(-2, 2)),
                userDataTime    = new Date(),
                userDataMinutes = Number(userDataTime.getMinutes()),
                userDataSeconds = Number(userDataTime.getSeconds());

            if (userDataMinutes > dataLogsMinutes) {
                var calcMinutes = (59 - userDataMinutes) + dataLogsMinutes;
            }
            else {
                var calcMinutes = (dataLogsMinutes - userDataMinutes);
            }

            if (userDataSeconds > dataLogsSeconds) {
                var calcSeconds = (59 - userDataSeconds) + dataLogsSeconds;
            }
            else {
                var calcSeconds = dataLogsSeconds - userDataSeconds;
            }

            var calcAllTime     = calcSeconds + (calcMinutes * 60),
                timeSeconds     = calcAllTime % 60,
                timeMinutes     = (calcAllTime - timeSeconds) / 60;

            var minutes = 0;
            var seconds = 0;

            function startArbitrageTimer() {

                // Основной цикл "Минуты"
                for (let i = 0; i <= timeMinutes; i++) {
                    // Второй цикл "Секунды в минуте"
                    for (let a = 0; a <= timeSeconds; a++) {

                        // Проверка на основное количество секунды
                        if (i == 0) {
                            timeSeconds = timeSeconds;
                        }
                        else if (i > 0) {
                            timeSeconds = 59;
                        }

                        let minutes = Number(timeMinutes - i);
                        let seconds = Number(timeSeconds - a);

                        // Проверка на кол-во минут
                        if (minutes >= 0 && minutes <= 9) {
                            minutes = "0" + minutes;
                        }
                        else {
                            minutes = minutes;
                        }

                        // Проверка на кол-во секунд
                        if (seconds >= 0 && seconds <= 9) {
                            seconds = "0" + seconds;
                        }
                        else {
                            seconds = seconds;
                        }

                        let text = `<small>${minutes}:${seconds}</small>`;

                        $(String(text)).appendTo(timerArbMinutes);

                        if (i == timeMinutes && a == timeSeconds) {
                            timeChildrenCount = $('.tcw-times small').length;
                            $('.tcw-times small').eq((timeChildrenCount - 1 - calcAllTime)).addClass('active');
                        }

                    }
                }
            }

            var ArbitragScanLoad1 = 0,
                ArbitragScanLoad2 = 0,
                ArbitragScanLoad3 = 0,
                ArbitragScanLoad4 = 0,
                ArbitragScanLoad5 = 0,
                ArbitragScanLoad6 = 0;

            // For delete
            function checkTimeFromTimer() {
                var calcTimeOut = 420 - calcAllTime;
                    ArbitragChildCounter -= calcTimeOut;

                for (i = 0; i <= calcTimeOut; i++) {
                    $('.tcw-times small').eq(0).remove();
                }
            }

            function exchangeLoadChecker() {
                if (calcAllTime < 400 && calcAllTime >= 340) {
                    ArbitragScanLoad1 += 1.25;
                    $('.scanning-content .sc-exchange').eq(0).find('.exchange .load').css('width', ArbitragScanLoad1 + "%");
                }
                else if (calcAllTime < 340 && calcAllTime >= 280) {
                    ArbitragScanLoad2 += 1;
                    $('.scanning-content .sc-exchange').eq(1).find('.exchange .load').css('width', ArbitragScanLoad2 + "%");
                }
                else if (calcAllTime < 280 && calcAllTime >= 220) {
                    ArbitragScanLoad3 += 1;
                    $('.scanning-content .sc-exchange').eq(2).find('.exchange .load').css('width', ArbitragScanLoad3 + "%");
                }
                else if (calcAllTime < 220 && calcAllTime >= 160) {
                    ArbitragScanLoad4 += 1;
                    $('.scanning-content .sc-exchange').eq(3).find('.exchange .load').css('width', ArbitragScanLoad4 + "%");
                }
                else if (calcAllTime < 160 && calcAllTime >= 100) {
                    ArbitragScanLoad5 += 1;
                    $('.scanning-content .sc-exchange').eq(4).find('.exchange .load').css('width', ArbitragScanLoad5 + "%");
                }
                else if (calcAllTime < 100 && calcAllTime >= 20) {
                    ArbitragScanLoad6 += 1;
                    $('.scanning-content .sc-exchange').eq(5).find('.exchange .load').css('width', ArbitragScanLoad6 + "%");
                }
            }
            function markLoadedChecker() {
                if (calcAllTime < 420 && calcAllTime >=400) {
                    $('.scanning-title .status').removeClass('online');
                    $('.scanning-title .status').addClass('load');
                }
                else if (calcAllTime < 400 && calcAllTime >=340) {
                    $('.scanning-title .status').removeClass('online');
                    $('.scanning-title .status').addClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('online');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('load');
                }
                else if (calcAllTime < 340 && calcAllTime >=280) {
                    $('.scanning-title .status').removeClass('online');
                    $('.scanning-title .status').addClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('online');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('load');
                }
                else if (calcAllTime < 280 && calcAllTime >=220) {
                    $('.scanning-title .status').removeClass('online');
                    $('.scanning-title .status').addClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('online');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('load');
                }
                else if (calcAllTime < 220 && calcAllTime >=160) {
                    $('.scanning-title .status').removeClass('online');
                    $('.scanning-title .status').addClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').removeClass('online');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').addClass('load');
                }
                else if (calcAllTime < 160 && calcAllTime >=100) {
                    $('.scanning-title .status').removeClass('online');
                    $('.scanning-title .status').addClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').removeClass('online');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').addClass('load');
                }
                else if  (calcAllTime < 100 && calcAllTime >=20) {
                    $('.scanning-title .status').removeClass('online');
                    $('.scanning-title .status').addClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').removeClass('online');
                    $('.scanning-content .sc-exchange').eq(5).find('.status').removeClass('online');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').addClass('load');
                    $('.scanning-content .sc-exchange').eq(5).find('.status').addClass('load');
                }
            }
            function onLoadStatusMark() {
                if (calcAllTime < 340 && calcAllTime >= 280) {
                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('complete');

                    $('.scanning-content .sc-exchange').eq(0).find('.exchange .load').css('width', "100%");
                }
                else if (calcAllTime < 280 && calcAllTime >= 220) {
                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('complete');

                    $('.scanning-content .sc-exchange').eq(0).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(1).find('.exchange .load').css('width', "100%");
                }
                else if (calcAllTime < 220 && calcAllTime >= 160) {
                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('complete');

                    $('.scanning-content .sc-exchange').eq(0).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(1).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(2).find('.exchange .load').css('width', "100%");
                }
                else if (calcAllTime < 160 && calcAllTime >= 100) {
                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').removeClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').addClass('complete');

                    $('.scanning-content .sc-exchange').eq(0).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(1).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(2).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(3).find('.exchange .load').css('width', "100%");
                }
                else if (calcAllTime < 100 && calcAllTime >= 20) {
                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').removeClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').addClass('complete');

                    $('.scanning-content .sc-exchange').eq(0).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(1).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(2).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(3).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(4).find('.exchange .load').css('width', "100%");
                }
                else if (calcAllTime < 20 && calcAllTime >= 0) {
                    $('.scanning-content .sc-exchange').eq(0).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').removeClass('load');
                    $('.scanning-content .sc-exchange').eq(5).find('.status').removeClass('load');

                    $('.scanning-content .sc-exchange').eq(0).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(1).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(2).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(3).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(4).find('.status').addClass('complete');
                    $('.scanning-content .sc-exchange').eq(5).find('.status').addClass('complete');

                    $('.scanning-content .sc-exchange').eq(0).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(1).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(2).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(3).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(4).find('.exchange .load').css('width', "100%");
                    $('.scanning-content .sc-exchange').eq(5).find('.exchange .load').css('width', "100%");
                }
            }

            $(document).ready(function() {
                startArbitrageTimer();

                // checkTimeFromTimer();

                var ArbitragSeconds = setInterval(function() {

                    timerHeightMinutes -= 90;
                    calcAllTime -= 1;

                    timerArbMinutes.css('top', timerHeightMinutes);

                    $('.tcw-times small.active').removeClass('active');
                    $('.tcw-times small').eq(((Number(($('.tcw-times small').length) - 1) - calcAllTime) + 2)).addClass('active');

                    // Загрзка при сканировании бирж
                    exchangeLoadChecker();
                    // Проверка статуса и работы
                    markLoadedChecker();
                    // Проверка на проскан. биржи
                    onLoadStatusMark();

                    if (calcAllTime == 0) {
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 2000) }
                }, 1000);
            });
        }
        $(document).ready(function() {

            // Arbitrage
            // Select wallet
            var selectListElement = $('.select-selected');

            selectListElement.click(function() {
                if ($('.select-selected').hasClass('active')) {
                    $('.select-selected').removeClass('active');
                    $('.select-list').removeClass('active');
                }
                else {
                    $('.select-selected').addClass('active');
                    $('.select-list').addClass('active');
                }
            });

            $('.select-list .list-element').each(function() {
                var thisBlock = $(this),
                    thisImg   = thisBlock.find('img').attr('src'),
                    thisValue = thisBlock.find('input').val();
                var editBLockImg = selectListElement.find('img'),
                    editBLockVal = selectListElement.find('input');

                thisBlock.click(function(){
                    if ($('.select-selected').hasClass('active')) {
                        editBLockImg.attr('src', thisImg);
                        editBLockVal.val(thisValue);

                        if (thisValue == "Bitcoin") {
                            $('.check-crypto input').prop('checked', false);
                            $('#check-bitcoin').prop('checked', true);
                        }
                        else if (thisValue == "Ethereum") {
                            $('.check-crypto input').prop('checked', false);
                            $('#check-ethereum').prop('checked', true);
                        }
                        else if (thisValue == "Ripple") {
                            $('.check-crypto input').prop('checked', false);
                            $('#check-ripple').prop('checked', true);
                        }

                        $('.select-selected').removeClass('active');
                        $('.select-list').removeClass('active');
                    }
                });
            });

            // Write sum
            var ArbSum = $('#arbitrage-sum'),
                formArbSum = $('#formArbSum');

            function checkedArbitrageSum() {
                if(ArbSum.val() < 10 || ArbSum.val() > parseInt(ArbSum.attr('max'))) {
                    ArbSum.addClass('error');
                }
                else {
                    ArbSum.removeClass('error');
                    formArbSum.val(ArbSum.val());
                }
            }

            ArbSum.keyup(function() {
                checkedArbitrageSum();
            });

            // Open deal
            var arbOpenDealBtn = $('.deal-start');

            arbOpenDealBtn.on("click", () => {
                if (Number(ArbSum.val()) >= 10 && Number(ArbSum.val()) <= parseInt(ArbSum.attr('max'))) {
                    ArbSum.removeClass('error');
                    arbOpenDealBtn.attr("disabled", true);
                    $('.arbitrageOpenDeal').submit();
                }
                else {
                    arbOpenDealBtn.attr("disabled", false);
                    ArbSum.addClass('error');
                }
            });

            // Количетво достпун. сделок
            function checkDealsCount() {
                var dealsCount = Number($('#dealsCounter').attr('data-deal-count')),
                    maxDealsCount = Number($('#dealsCounter').attr('data-max-deal-count'));

                $('#dealsCounter .actual-count .actual').text(dealsCount);

                if (dealsCount == maxDealsCount) {
                    $('.actual-count').css('width', 100 + '%');
                    $('.tape-bg-full').css('width', 100 + '%');

                    $('.counter .max').addClass('hide');
                }
                else if (dealsCount == (maxDealsCount - 1)) {
                    var result = (dealsCount / maxDealsCount) * 100;

                    $('.counter .max').addClass('hide');

                    $('.actual-count').css('width', result  + '%');
                    $('.tape-bg-full').css('width', result  + '%');
                }
                else if (dealsCount < maxDealsCount && dealsCount != 0) {
                    var result = (dealsCount / maxDealsCount) * 100;

                    $('.counter .min').removeClass('hide');
                    $('.counter .max').removeClass('hide');

                    $('.actual-count').css('width', result  + '%');
                    $('.tape-bg-full').css('width', result  + '%');
                }
                else if (dealsCount == 0) {
                    $('.actual-count').css('width', '3%');
                    $('.tape-bg-full').css('width', '0%');

                    $('.counter .min').addClass('hide');
                }
            }
            checkDealsCount();

            var dealCompletedReload = $('button#reload');

            dealCompletedReload.click(function() {
                window.location.reload(true);
            });
        });
    </script>
@endsection
