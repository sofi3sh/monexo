<input type="hidden" id="rate-bitcoin" data-bitcoin="{{Auth()->user()->getCurrencyeUsd('bitcoin')}}">
<input type="hidden" id="rate-ethereum" data-ethereum="{{Auth()->user()->getCurrencyeUsd('ethereum')}}">
<input type="hidden" id="rate-tether" data-tether="{{Auth()->user()->getCurrencyeUsd('tether')}}">
<input type="hidden" id="rate-prizm" data-prizm="{{Auth()->user()->getCurrencyeUsd('prizm')}}">

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-5">
                <h3 class="mb-0">@lang('base.dash.balance.withdraw') </h3>
            </div>
            <div class="col-7 text-right pl-0">
                {{-- <a href="{{route('home.balance')}}"
                    class="btn btn-sm btn-primary">
                    @lang('base.dash.balance.replenish_balance')
                </a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('home.balance.request.withdrawal')}}" method="POST" id="form-withdrawal">
            @csrf
            <h6 class="heading-small text-muted mb-4">@lang('base.dash.balance.system')</h6>
            <div class="pl-lg-4">
                <div class="row">
                    {{-- <div class="balans-form__item col mb-2">
                        <input
                            type="radio"
                            class="withdrawal-item"
                            name="currency_id"
                            id="pay-11"
                            data-currency-code="USD"
                            data-payment-system="payeer"
                            value="18"
                            data-conclusion="2"
                            checked>
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-1.png')}}" alt="">
                            </div>
                            Payeer
                        </div>
                    </div> --}}
                    <div class="balans-form__item form-payment col mb-2">
                        <input
                            type="radio"
                            class="withdrawal-item"
                            name="currency_id"
                            name="pay"
                            data-currency-code="USDT"
                            data-payment-system="usdt"
                            id="pay-17"
                            value="29" checked>
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-7.png')}}" alt="">
                            </div>
                            Tether (TRC 20)
                        </div>
                    </div>
                    <div class="balans-form__item col mb-2 dis" >
                        <input
                            type="radio"
                            class="withdrawal-item"
                            name="currency_id"
                            id="pay-12"
                            data-currency-code="BTC"
                            data-payment-system="btc"
                            disabled="disabled"
                            value="1"
                            data-conclusion="3">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-3.png')}}" alt="">
                            </div>
                            Bitcoin (@lang('base.general.soon'))
                        </div>
                    </div>
                    <div class="balans-form__item col mb-2 dis">
                        <input
                            type="radio"
                            class="withdrawal-item"
                            name="currency_id"
                            id="pay-15"
                            data-currency-code="ETH"
                            data-payment-system="eth"
                            disabled="disabled"
                            value="2"
                            data-conclusion="3">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-4.png')}}" alt="">
                            </div>
                            Ethereum (@lang('base.general.soon'))
                        </div>
                    </div>
                    {{-- <div class="balans-form__item col mb-2">
                        <input
                            type="radio"
                            class="withdrawal-item"
                            name="currency_id"
                            id="pay-13"
                            data-conclusion="1.5"
                            data-currency-code="PZM"
                            data-payment-system="pzm"
                            value="25">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/prizm.png')}}" alt="">
                            </div>
                            Prizm
                        </div>
                    </div>
                    <div class="balans-form__item col mb-2">
                        <input
                            type="radio"
                            class="withdrawal-item"
                            name="currency_id"
                            id="pay-14"
                            data-currency-code="USD"
                            data-payment-system="perfect"
                            value="22"
                            data-conclusion="1">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-2.png')}}" alt="">
                            </div>
                            Perfect Money
                        </div>
                    </div> --}}
                    <div class="balans-form__item col mb-2 dis">
                        <input
                            type="radio"
                            class="withdrawal-item"
                            name="currency_id"
                            id="pay-16"
                            value="16"
                            data-currency-code="USD"
                            data-payment-system="credit card"
                            data-limit="{{$withdrawalLimits['card']}}"
                            disabled="disabled"
                            data-conclusion="2">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-6.png')}}" alt="">
                            </div>
                            Credit Card (@lang('base.general.soon'))
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4" />
            <div class="row">
                <h6 class="col-12 col-md-6 heading-small text-muted commission m-0">
                    @lang('base.dash.balance.minimum_payout') 25 USDT / @lang('base.dash.balance.withdraw_commission') 1 USDT
                </h6>
                <div class="col-12 col-md-6 text-muted text-sm text-left text-md-center d-flex align-items-center flex-wrap">
                    <button
                        type="button"
                        class="btn btn-link p-0 text-sm text-wrap"
                        id="withdrawalModalButton"
                        data-toggle="modal"
                        data-target="#withdrawalModalUSDT">@lang('base.dash.balance.conclusion.info')
                    </button>
                </div>
            </div>
            <p class="withdraw-errors"></p>
            <div class="row">
                <div class="col-6 mb-4">
                    <input
                        required
                        type="number"
                        min="0"
                        placeholder="0 USD"
                        name="amount"
                        id="input-conclusion"
                        data-paysystem="usdt"
                        data-max="100000000"
                        data-min="0"
                        class="input-conclusion form-control withdrawal-input-number"
                        step="0.01"
                    >
                </div>
                <div class="col-6 mb-4">
                    <input
                        required
                        type="text"
                        placeholder="@lang('base.dash.balance.withdraw_wallet')"
                        name="address"
                        id="input-conclusion"
                        class="input-conclusion withdrawal-purse form-control">
                </div>
            </div>
            <div class="row crypto_details fieldd_wrapper" style="display: none">
                <div class="col-12">
                    <h4>@lang('base.dash.balance.crypto_details.title')</h4>
                </div>
                <div class="col-12 mb-4">
                    <textarea
                        type="text"
                        placeholder="@lang('base.dash.balance.crypto_details.memo')"
                        name="crypto_memo"
                        class="name_field form-control"></textarea>
                </div>
            </div>
            <div class="row card_details fieldd_wrapper" style="display: none">
                <div class="col-12">
                    <h4>@lang('base.dash.balance.card_details.title')</h4>
                </div>
                <div class="col-4 mb-4">
                    <input
                        disabled
                        type="text"
                        placeholder="@lang('base.dash.balance.card_details.surname')"
                        name="card_surname"
                        class="js-only-cyrylic name_field form-control"/>
                </div>
                <div class="col-4 mb-4">
                    <input
                        disabled
                        type="text"
                        placeholder="@lang('base.dash.balance.card_details.name')"
                        name="card_name"
                        class="js-only-cyrylic name_field form-control"/>
                </div>
                <div class="col-4 mb-4">
                    <input
                        disabled type="text"
                        placeholder="@lang('base.dash.balance.card_details.patronymic')"
                        name="card_patronymic"
                        class="js-optional js-only-cyrylic name_field form-control"/>
                </div>
                <div class="col-6 mb-4">
                    <input
                        disabled
                        type="text"
                        placeholder="@lang('base.dash.balance.card_details.phone')"
                        name="card_phone"
                        class="name_field form-control"/>
                </div>
                <div class="col-6 mb-4">
                    <input
                        disabled type="text"
                        placeholder="@lang('base.dash.balance.card_details.inn')"
                        name="card_number"
                        class="js-optional name_field form-control"/>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <input
                        type="submit"
                        form="form-withdrawal"
                        class="btn btn-primary"
                        value="@lang('base.dash.balance.button-withdraw')">
                </div>
                <div class="col-9 d-flex align-items-center">
                    <label for="result-conclusion" class="mr-1">@lang('base.dash.balance.summury')</label>
                    <input type="text" readonly="" name="amount1" class="form-control" id="result-conclusion" value="">
                </div>
            </div>
        </form>
    </div>
</div>
