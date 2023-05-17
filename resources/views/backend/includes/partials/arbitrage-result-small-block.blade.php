<div class="last-deal acsi-block">
    <div class="ld-title">
        <h2>{{ __('arbitrage.main.last-deal.title') }}</h2>
    </div>
    <div class="ld-content">
        <div class="ld-data">
            <div class="ld-data--info">
                <h5>{{ __('arbitrage.main.last-deal.sum') }}:</h5>
                <span>${{ $active_arbitrage->amount_usd }}</span>
            </div>
            <div class="ld-data--info">
                <h5>{{ __('arbitrage.main.last-deal.buy') }}:</h5>
                <span>{{ $active_arbitrage->buyCryptocurrencyExchange()->first()->name }}</span>
            </div>
            <div class="ld-data--info">
                <h5>{{ __('arbitrage.main.last-deal.sale') }}:</h5>
                <span>{{ $active_arbitrage->sellCryptocurrencyExchange()->first()->name }}</span>
            </div>
            <div class="ld-data--info">
                <h5>{{ __('arbitrage.main.last-deal.rate') }}:</h5>
                <span>${{ $active_arbitrage->sell_rate }}</span>
            </div>
            <div class="ld-data--info">
                <h5>{{ __('arbitrage.main.last-deal.start') }}:</h5>
                <span>{{ $active_arbitrage->start }}</span>
            </div>
            <div class="ld-data--info">
                <h5>{{ __('arbitrage.main.last-deal.end') }}:</h5>
                <span>{{ $active_arbitrage->end }}</span>
            </div>
        </div>
        <div class="ld-result-sum">
            <span></span>
            <h3 class="last-deal-sum">{{ $active_arbitrage->user_profit_usd }}</h3>
            <small>usd</small>
        </div>
    </div>
</div>