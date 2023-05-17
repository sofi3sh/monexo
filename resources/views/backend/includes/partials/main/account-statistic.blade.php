<div class="wrapper--border wrapper-main wrapper-responsive">
    {{-- 3аголовок блока --}}
    <div class="col-xl-12">
        <h3>{{ __('strings.backend.home.my-result') }}</h3>
    </div>
    <div class="col-xl-12">
        <table class="wrapper-stats--table">
            <thead class="wst--head">
                <tr>
                    <th>{{ __('strings.backend.stat.balance') }}</th>
                    <th>{{ __('strings.backend.stat.invested') }}</th>
                    <th>{{ __('strings.backend.stat.profit') }}</th>
                    <th>{{ __('strings.backend.stat.paid') }}</th>
                </tr>
            </thead>
            <tbody class="wst--body">
                <tr>
                    <td>{{ number_format($user->balance_usd, 2) }}$</td>
                    <td>{{ number_format($user->invested_usd, 2) }}$</td>
                    <td>{{ number_format($user->profit_usd, 2) }}$</td>
                    <td>{{ number_format($user->withdrawal_usd, 2) }}$</td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- <div class="stats stats--block">
        <div class="wrapper--border wrapper-main wrapper-responsive">
            <div class="wrapper-stats--block">
                <div>{{ __('strings.backend.stat.referrals') }}</div>
                <div class="stats--block-money">${{ number_format($user->referrals_usd, 2) }}</div>
            </div>
            <div class="wrapper-stats--block">
                <div>{{ __('strings.backend.stat.withdrawals_requests') }}</div>
                <div class="stats--block-money">${{ number_format($user->withdrawal_request_usd, 2) }}</div>
            </div>
            <div class="wrapper-stats--block">
                <div>{{ __('strings.backend.stat.available_withdrawal') }}</div>
                <div class="stats--block-money">${{ number_format($user->getAmountAvailableWithdrawal(), 2) }}</div>
            </div>
            <a class="wrapper-stats--block wrapper-invest--block" href="https://fenix24.net/home/invest">
                {{ __('strings.backend.home.invest-btn') }}
            </a>
        </div>
    </div> --}}
</div>