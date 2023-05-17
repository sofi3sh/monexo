{{-- Select type form --}}
<form action="https://el-change.com/merchant_pay" method="POST" class="base_form merchant_form" target="_blank">
    <h2 class="title">@lang('cabinet_invest.invest_form.title')</h2>
    
    {{-- Выбор платежной системы --}}
    <div class="block">
        <label for="withdrawals_sum">@lang('cabinet_invest.invest_form.system')</label>
        <div class="base_select">
            <div class="elements_selected">
                <div class="block active">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/merchant-icons/BTC.png') }}" alt="graybet Withdrawals">
                    </div>
                    <p class="text">Bitcoin</p>
                </div>
            </div>
            <small class="arrow">
                @include('backend.includes.partials.svg.user_arrow')
            </small>
            <div class="elements_list">
                @foreach ($rates as $num_el=>$rate)
                    <div class="block" data-find-box="{{ $rate->send_paysys_identificator }}">
                        <div class="logo">
                            <img src="{{ asset('backend/production/img/merchant-icons/' . $rate->send_paysys_identificator . '.png') }}" alt="graybet Withdrawals">
                        </div>
                        <p class="text">{{ $rate->send_paysys_title }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Предупреждение об оплате картами Visa\MasterCard --}}
    <div class="control">
        <p class="info" style="max-width: 100%; width: 100%; margin-bottom: 20px;">@lang('cabinet_invest.invest_form.card_attention')</p>
    </div>
    
    {{-- Сумма --}}
    <div class="block">
        <label for="amount">@lang('cabinet_invest.invest_form.amount')</label>
        <input type="number" id="amount" name="amount" step="any" required>
        <small class="input-ending">USD</small>
    </div>

    {{-- Скрытые поля для выбора платежной системы через интерфейс выпадающего списка --}}
    <div class="block hidden list_merchant_system">
        @foreach ($rates as $num_el=>$rate)
            <input @if ($rate->send_paysys_identificator == 'BTC') checked="checked" @endif id="payed_paysys_{{ $rate->send_paysys_identificator }}" name="payed_paysys" type="radio" value="{{ $rate->send_paysys_identificator }}"/>
            <h5>{{ $rate->send_paysys_title }}</h5>
        @endforeach
    </div>

    {{-- Скрытые поля для мерчанта --}}
    <input type="hidden" name="merchant_name" value={{ config('el-change.merchant_name') }} />
    <input type="hidden" name="merchant_title" value="graybet Company"/>
    <input type="hidden" name="payment_info" value="@lang('cabinet_invest.invest_form.title') {{ $user->email }}"/>
    <input type="hidden" name="payment_num" value="{{ $paymentNum }}"/>
    <input type="hidden" name="sucess_url" value="{{ route('home.invest', 'success') }}"/>
    <input type="hidden" name="error_url" value="{{ route('home.invest', 'error') }}"/>

    {{-- Кнопка "Оплатить" для перехода на этап оплаты --}}
    <div class="control">
        <p class="info">@lang('cabinet_invest.invest_form.info')</p>
        <button type="submit">@lang('cabinet_invest.invest_form.button')</button>
    </div>

</form>

{{-- Временно для проверки ответа с мерча --}}
@if($status == 'success')
    <div class="base_alert alert_danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @lang('cabinet_invest.invest_form.success')<br/>
    </div>
@elseif($status == 'error')
    <div class="base_alert alert_danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @lang('cabinet_invest.invest_form.error')<br/>
    </div>
@endif