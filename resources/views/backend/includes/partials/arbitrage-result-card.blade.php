<div class="arbitrage-result-card">
    <div class="arc-title">
        <h3>{{ __('arbitrage.result.title') }}</h3>
    </div>
    <div class="arc-content">
        <div class="arc-content-info">
            <span><h4>{{ __('arbitrage.result.info1') }}:</h4><p>{{ $active_arbitrage->start }}</p></span>
            {{--<span><h4>{{ __('arbitrage.result.info2') }}:</h4><p>{{ $active_arbitrage->start }}</p></span>--}}
            <span><h4>{{ __('arbitrage.result.info3') }}:</h4><p>${{ $active_arbitrage->amount_usd }}</p></span>
            <span><h4>{{ __('arbitrage.result.info4') }} :</h4><p>{{ $active_arbitrage->amountBuyOfCryptocurrency() . ' ' . $active_arbitrage->currency->code }}</p></span>
            <span><h4>{{ __('arbitrage.result.info5') }}:</h4><p>${{ $active_arbitrage->buy_rate }}</p></span>
            <span><h4>{{ __('arbitrage.result.info6') }}:</h4><p>${{ $active_arbitrage->amountUsdOfSale() }}</p></span>
            <span><h4>{{ __('arbitrage.result.info7') }}:</h4><p>${{ $active_arbitrage->sell_rate }}</p></span>
            <span><h4>{{ __('arbitrage.result.info8') }}:</h4><p>{{ config('finance.service_arbitrage_commission') }}
                    %</p></span>
            <div class="arc-btn-reload">
                <button id="reload" class="reload">{{ __('arbitrage.result.reload') }}</button>
            </div>
        </div>
        <div class="arc-content-data">
            <div class="data-block">
                <div class="db-title">
                    <h5>{{ __('arbitrage.result.card-1') }}:</h5>
                </div>
                <div class="db-result">
                    <span>{{ $active_arbitrage->user_profit_usd }}$</span>
                </div>
            </div>
            <div class="data-block">
                <div class="db-title">
                    <h5>{{ __('arbitrage.result.card-2') }}:</h5>
                </div>
                <div class="db-result">
                    <span>{{ $active_arbitrage->buyCryptocurrencyExchange()->first()->name }}</span>
                    <span class="arrow">
                        <small>&#10142;</small>
                        <small>&#10142;</small>
                    </span>
                    <span>{{ $active_arbitrage->sellCryptocurrencyExchange()->first()->name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>