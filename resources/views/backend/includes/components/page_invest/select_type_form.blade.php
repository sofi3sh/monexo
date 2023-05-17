{{-- Select type form --}}
<form action="#" method="GET" style="margin: 10px 0px -10px;" class="base_form">
    <h2 class="title">Пополнение баланса</h2>
    
    <div class="block">
        <label for="withdrawals_sum">Платежная система</label>
        <div class="base_select">
            <div class="elements_selected">
                <div class="block active">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/currency-icons/gr-Visa USD.png') }}" alt="graybet Withdrawals">
                    </div>
                    <p class="text">Visa</p>
                </div>
            </div>
            <small class="arrow">
                @include('backend.includes.partials.svg.user_arrow')
            </small>
            <div class="elements_list">
                @foreach($wallets as $wallet)
                    @if(is_null($wallet->address))
                        <div class="block">
                            <div class="logo">
                                <img src="{{ asset('backend/production/img/currency-icons/gr-' . $wallet->code . '.png') }}" alt="graybet Withdrawals">
                            </div>
                            <form action="{{ route('home.invest.genWallet', ['currencyId' => $wallet->currency_id])}}"
                                method="POST">
                                <button type="submit">{{ $wallet->name}} (Сгененрировать)</button>
                            </form>
                        </div>
                    @else
                        <div class="block" data-type="crypto_currency" data-address="{{ $wallet->address}}" data-add-address="{{ $wallet->additional_data}}">
                            <div class="logo">
                                <img src="{{ asset('backend/production/img/currency-icons/gr-' . $wallet->code . '.png') }}" alt="graybet Withdrawals">
                            </div>
                            <p class="text">{{ $wallet->name}}</p>
                        </div>
                    @endif
                @endforeach
                
                {{-- Другие платежные системы (Которые обрабатываются вручную) --}}
                <div class="block" data-type="cards">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/currency-icons/gr-Visa USD.png') }}" alt="graybet Withdrawals">
                    </div>
                    <p class="text">Visa</p>
                </div>
                <div class="block" data-type="cards">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/currency-icons/gr-mc (usd).png') }}" alt="graybet Withdrawals">
                    </div>
                    <p class="text">MasterCard</p>
                </div>
                <div class="block" data-type="eps" data-address="P455182912">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/currency-icons/gr-payeer usd.png') }}" alt="graybet Withdrawals">
                    </div>
                    <p class="text">Payeer</p>
                </div>
                <div class="block" data-type="eps" data-address="79658885248">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/currency-icons/gr-qiwi usd.png') }}" alt="graybet Withdrawals">
                    </div>
                    <p class="text">QiWi (USD)</p>
                </div>
                <div class="block" data-type="other">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/currency-icons/gr--.png') }}" alt="graybet Withdrawals">
                    </div>
                    <p class="text">Other system</p>
                </div>
            </div>
        </div>
    </div>
</form>