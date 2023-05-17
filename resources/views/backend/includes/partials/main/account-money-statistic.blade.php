<div class="wrapper-user-stats--block grey-border-gg">
    <div class="wus--block-login">
        {{ Auth::user()->email }}
    </div>
    <div class="wus--block-money">
        <div class="block-money--balance">
            <h5>
                {{ __('strings.backend.stat.balance') }}:
            </h5>
            <span>
                {{ number_format($user->balance_usd, 2) }}$
            </span>
        </div>
        <a class="block-money--btn" href="https://fenix24.net/home/invest">
            {{ __('strings.backend.home.invest-btn') }}
        </a>
    </div>
    <div class="wus--block-money">
        <div class="block-money--referrals">
            <h5>
                {{ __('strings.backend.stat.referrals') }}:
            </h5>
            <span>
                {{ number_format($user->referrals_usd, 2) }}$
            </span>
        </div>
    </div>
</div>