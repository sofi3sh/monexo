<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-5">
                <h3 class="mb-0">@lang('base.dash.balance.replenishment') </h3>
            </div>
            <div class="col-7 text-right pl-0">
                {{-- <button onclick="paydir()" class="btn btn-sm btn-primary">@lang('base.dash.balance.withdraw')</button> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form  action="{{route('home.balance.payment')}}" id="form-payment" method="GET">
            @csrf
            <h6 class="heading-small text-muted mb-4">@lang('base.dash.balance.system')</h6>
            <div class="pl-lg-4">
                <div class="row balans-form">
                    {{-- <div class="balans-form__item form-payment col mb-2">
                        <input
                            type="radio"
                            class="pay-item"
                            name="pay"
                            data-amount-type="USD"
                            data-payment-system="payeer"
                            id="pay-1"
                            value="payeer"
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
                            class="pay-item"
                            name="pay"
                            data-amount-type="USDT"
                            data-payment-system="tether"
                            id="pay-7"
                            value="usdt" checked>
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-7.png')}}" alt="">
                            </div>
                            Tether (TRC 20)
                        </div>
                    </div>
                    <div class="balans-form__item form-payment col mb-2 dis">
                        <input
                            type="radio"
                            class="pay-item"
                            name="pay"
                            data-amount-type="BTC"
                            data-payment-system="bitcoin"
                            disabled="disabled"
                            id="pay-2"
                            value="btc">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-3.png')}}" alt="">
                            </div>
                            Bitcoin (@lang('base.general.soon'))
                        </div>
                    </div>
                    <div class="balans-form__item form-payment col mb-2 dis">
                        <input
                            type="radio"
                            class="pay-item"
                            name="pay"
                            data-amount-type="ETH"
                            data-payment-system="ethereum"
                            disabled="disabled"
                            id="pay-5"
                            value="eth">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-4.png')}}" alt="">
                            </div>
                            Ethereum (@lang('base.general.soon'))
                        </div>
                    </div>
                    {{-- <div class="balans-form__item form-payment col mb-2">
                        <input
                            type="radio"
                            class="pay-item"
                            name="pay"
                            id="pay-3"
                            data-amount-type="PZM"
                            data-payment-system="prizm"
                            value="pzm">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/prizm.png')}}" alt="">
                            </div>
                            Prizm
                        </div>
                    </div>
                    <div class="balans-form__item form-payment col mb-2">
                        <input
                            type="radio"
                            class="pay-item"
                            name="pay"
                            data-amount-type="USD"
                            data-payment-system="perfect_money"
                            id="pay-4"
                            value="pm">
                        <div class="balans-form__content">
                            <div class="balans-form__pic mb-1">
                                <img src="{{asset('images/lk/pay-2.png')}}" alt="">
                            </div>
                            Perfect Money
                        </div>
                    </div> --}}
                    <div class="balans-form__item form-payment col mb-2 dis">
                        <input
                            type="radio"
                            class="pay-item"
                            name="pay"
                            id="pay-6"
                            value="card"
                            data-amount-type="USD"
                            disabled="disabled"
                            data-payment-system="card">
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
            <h6 class="heading-small text-muted mb-4">
                @lang('base.dash.balance.replenishment_amount')
                <span> {!! str_replace('%s', '20 USDT', __('base.dash.balance.replenishment_amount_min')) !!}</span>
            </h6>
            <div class="row">
                <div class="col-6 mb-4">
                    <input
                        data-inputPay
                        required
                        type="number"
                        name="summ"
                        id="input-postal-code"
                        step="0.0001"
                        class="form-control"
                        placeholder="0 USD">
                </div>
                <div class="col-12 col-md-6 text-muted text-sm text-left text-md-center d-flex align-items-center mb-4 flex-wrap">
                    <span class="mr-1">@lang('base.dash.payments_methods.btn-prev')</span>
                    <button type="button" class="btn btn-link p-0 text-sm" data-toggle="modal" id="modalDescPaymentsButton" data-target="#modalDescPaymentsUSDT">
                        @lang('base.dash.payments_methods.btn')
                        <span>Tether</span>
                    </button>
                </div>
                <div class="col-6">
                    <input
                        data-buttonPay
                        type="submit"
                        form="form-payment"
                        class="btn btn-primary"
                        value="@lang('base.dash.balance.button-replenishment')">
                </div>
            </div>
        </form>
    </div>
</div>
