{{-- Cards form --}}
<form action="{{ route('home.withdrawal.store') }}" method="POST" class="base_form">
    @csrf

    <h2 class="title">@lang('cabinet_withd.form.title')</h2>

    <div class="block">
        <label for="amount_usd">@lang('cabinet_withd.form.amount')</label>
        <input type="number" id="amount_usd" name="amount_usd" step="0.01" min="1">
        <small class="input-ending">USD</small>
    </div>

    {{-- Галка, что выводить только реферальные --}}
    <div class="block">
        <input type="checkbox" name="onlyReferrals" id="onlyReferrals">
        <label for="onlyReferrals">
            <span class="status"></span>
            Только реферальные
        </label>
    </div>

    <div class="block">
        <label for="base_select">@lang('cabinet_withd.form.system')</label>
        <div class="base_select">
            <div class="elements_selected">
                <div class="block active">
                    <div class="logo">
                        <img src="{{ asset('backend/production/img/currency-icons/gr-btc.png') }}" alt="Agio Withdrawals">
                    </div>
                    <p class="text">Bitcoin</p>
                </div>
            </div>
            <small class="arrow">
                @include('backend.includes.partials.svg.user_arrow')
            </small>
            <div class="elements_list">
                {{-- Криптовалюты --}}
                @foreach($view_model->currencies() as $currency)
                    <div class="block crypto">
                        <div class="logo">
                            <img src="{{ asset('backend/production/img/currency-icons/gr-' . $currency->code . '.png') }}" alt="Agio Withdrawals">
                        </div>
                        <p class="text">{{ $currency->name }}</p>
                        <input class="currency_id" type="hidden" value="{{ $currency->id }}" readonly>
                    </div>
                @endforeach

                {{-- Другие системы для вывода --}}
                @foreach($view_model->paymentSystems() as $currency)
                    <div class="block">
                        <div class="logo">
                            <img src="{{ asset('backend/production/img/currency-icons/gr-' . $currency->code . '.png') }}" alt="Agio Withdrawals">
                        </div>
                        <p class="text">{{ $currency->name }}</p>
                        <input class="currency_id" type="hidden" hidden value="{{ $currency->id }}" readonly>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="block">
        <label for="address">@lang('cabinet_withd.form.account')</label>
        <input type="text" id="address" name="address">
    </div>
    <div class="block">
        <label for="additional_data">@lang('cabinet_withd.form.name')</label>
        <input type="text" id="additional_data" name="additional_data">
    </div>

    {{-- Поля для контроля формы --}}
    {{-- ID выбранной системы для вывода --}}
    <input hidden type="text" value="1" name="currency_id" id="withdrawal_currency_id">
    {{-- На EРS или нет - галочка --}}
    <input hidden type="checkbox" id="to_payment_systems" name="to_payment_systems">

    {{-- Доступная сумма --}}
    <p style="font-size: 16px; color: #252525; font-family: 'Fira Sans', sans-serif;">@lang('cabinet_withd.form.available', ['sum' => number_format($view_model->user->getAmountAvailableWithdrawal(), 2)])</p>
    {{-- Комиссия на вывод --}}
    <input type="hidden" name="percent" value="{{ $user->getCommissionForWithdrawal() }}"/>
    <p style="font-size: 16px; color: #252525; font-family: 'Fira Sans', sans-serif; margin-top: 6px;">@lang('cabinet_withd.form.commission', ['sum' => number_format($user->getCommissionForWithdrawal(), 2,'.', ',')])</p>

    <div class="control">
        <p class="info">@lang('cabinet_withd.form.info')</p>
        <button @if(!Auth::user()->can_confirm_withdrawal) disabled @endif>@lang('cabinet_withd.form.button')</button>
    </div>
</form>

@section('scripts')
    <script>
        $(document).ready(function () {
            let wf_base_select = $(".base_select .elements_list .block");

            wf_base_select.each(function() {
                let ths = $(this);

                ths.on("click", () => {
                    // Currency ID
                    let currency_id = ths.find("input.currency_id").val();
                    // Type system
                    let type_system;

                    if (ths.hasClass("crypto")) {
                        $("#to_payment_systems").prop('checked', false);
                    } else {
                        $("#to_payment_systems").prop('checked', true);
                    }
                    $("#withdrawal_currency_id").val(currency_id);
                });
            });
        })
    </script>
@endsection
