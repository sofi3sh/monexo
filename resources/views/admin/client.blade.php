@extends('layouts.admin')
@section('css')
<style type="text/css">
    button:active, button:focus, button:hover  {
        outline: none !important;
    }
</style>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if($user->admin)
                    <h2 style="color: #e82836">Админ</h2>
                @endif
            </div>
        </div>
        <br>

        @include('admin.includes.partials.client.motivation-plan')

        @include('includes.partials.messages')


        @if(session('status'))
            <div class="alert alert-primary">
                {{ session('status') }}
            </div>
        @endif

        <br>

        {{-- Навигация по вкладкам --}}
        <ul class="nav nav-tabs nav-tabs--transactions" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#main-statistic" role="tab" aria-selected="true">
                    Статистика
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#withdrawal-requests" role="tab" aria-selected="false">
                    Заявки на вывод
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#enter-transaction" role="tab" aria-selected="false">
                    Вводы средств
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#transactions" role="tab" aria-selected="false">
                    Транзакции
                </a>
            </li>
            @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'admin@mail.ru')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#transaction-creation" role="tab" aria-selected="false">
                        Создание транзакций
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#up_partners" role="tab" aria-selected="false">
                    Вышестоящие партнеры
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#accrue" role="tab" aria-selected="false">
                    Начисления
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#accrue_bonuses" role="tab" aria-selected="false">
                    Начисления бонусов
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#actions" role="tab" aria-selected="false">
                    Действия
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.client.packages-statistics', ['email' => $user->email])}}">
                    Статистика по пакетам
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.client.verify', ['email' => $user->email])}}">
                    Верификация
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#wallets" role="tab" aria-selected="false">
                    Кошельки
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#payments" role="tab" aria-selected="false">
                    Скрины оплат
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#transfer" role="tab" aria-selected="false">
                    Перевод между аккаунтами
                </a>
            </li> --}}
        </ul>

        {{-- Содержание вкладок --}}
        <div class="admin-content-block-border" style="padding: 0px;">
            <div class="tab-content mytab-content">

                {{-- Статистика --}}
                <div class="tab-pane fade show active" id="main-statistic" role="tabpanel" aria-labelledby="home-tab">
                    <div class="admin-content-block">
                        @include('admin.includes.partials.client.main-statistic')
                    </div>
                </div>

                {{-- Заявки на вывод --}}
                <div class="tab-pane fade show" id="withdrawal-requests" role="tabpanel">
                    <div class="admin-content-block">
                        @include('admin.includes.partials.client.withdrawal-requests')
                    </div>
                </div>

                {{-- Вводы средств --}}
                <div class="tab-pane fade show" id="transactions" role="tabpanel">
                    <div class="admin-content-block">
                        @include('admin.includes.partials.client.transaction')
                    </div>
                </div>

                {{-- Транзакции --}}
                <div class="tab-pane fade show" id="enter-transaction" role="tabpanel">
                    <div class="admin-content-block">
                        @include('admin.includes.partials.client.enter-transaction')
                    </div>
                </div>

                {{-- Создание транзакций --}}
                @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'admin@mail.ru')
                    <div class="tab-pane fade show" id="transaction-creation" role="tabpanel">
                        <div class="admin-content-block">
                            @include('admin.includes.partials.client.transaction-creation')
                        </div>
                    </div>
                @endif

                {{-- Вышестоящие партнеры --}}
                <div class="tab-pane fade show" id="up_partners" role="tabpanel">
                    <div class="admin-content-block">
                        {{-- Вывод последовательности кто кого привел --}}
                        @foreach($user->getAncestors(20) as $sr)
                            {{-- Не выводим предка с id=1, поскольку все, кто пришел не по реф. ссылке, ставятся под него --}}
                            @if($sr->id <> 1)
                                <a href="{{ route('admin.client', $sr->id) }}">
                                    {{ $sr->email }}
                                </a>
                                ->
                                @if ($loop->last)
                                    {{ $user->email }}
                                    (текущий)
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>

                 {{-- Начисления --}}
                <div class="tab-pane fade show" id="accrue" role="tabpanel">
                    <div class="admin-content-block">
                        <div class="col-md-6">
                            <p class="text-success replenish-success-message"></p>
                            <form method="post" action="{{route('admin.replenish-balance', $id)}}" id="replenish-balance-form">
                                @csrf
                              <div class="form-group">
                                <label for="amount">Сумма</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="0.00">
                                <div class="invalid-feedback"></div>
                              </div>
                              <div class="form-group">
                                <label for="payment-system">Платежная система</label>
                                <select class="form-control" id="payment-system" name="currency_id">
                                    <option value="18">Payeer</option>
                                    <option value="22">Perfect Money</option>
                                </select>
                              </div>
                              <button type="submit" class="button settings-profile--submit-button">Начислить</button>
                            </form>
                        </div>
                    </div>
                </div>

                 {{-- Начисления бонусы --}}
                <div class="tab-pane fade show" id="accrue_bonuses" role="tabpanel">
                    <div class="admin-content-block">
                        <div class="col-md-6">
                            <p class="text-success replenish-bonuses-success-message"></p>
                            <form method="post" action="{{route('admin.replenish-bonuses', $id)}}" id="replenish-bonuses-form">
                                @csrf
                              <div class="form-group">
                                <label for="bonus">Бонусы</label>
                                <input type="number" class="form-control" id="bonus" name="bonus" placeholder="0.00">
                                <div class="invalid-feedback"></div>
                              </div>
                              <button type="submit" class="button settings-profile--submit-button">Начислить</button>
                            </form>
                        </div>
                    </div>
                </div>

                 {{-- Действия --}}
                <div class="tab-pane fade show" id="actions" role="tabpanel">
                    <div class="admin-content-block">
                        <div class="col-md-6">
                            <div class="admin-content-block">
                                <div class="mb-2">
                                    <strong>Возможность создавать заявки на вывод криптовалют</strong> <br>{{ $user->name }} ({{ $user->email }})
                                </div>

                                <form action="{{ route('admin.revert-can-withdrawal-crypto', $user->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    @if ($user->is_allow_withdraw_crypto)
                                        <button type="submit" class="btn btn-warning">Запретить</button>
                                    @else
                                        <button type="submit" class="btn btn-primary">Разрешить</button>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <hr>

                        @if(optional($user->userBonus)->is_regional_representative_status_available)
                            <div class="col-md-6">
                                <div class="admin-content-block">
                                    <div class="mb-2">
                                        <strong>Статус регионального представителя</strong>
                                        <br>{{ $user->name }} ({{ $user->email }})
                                    </div>

                                    <form method="post" action="{{route('admin.client.toggle_status', ['user' => $id, 'status' => \App\Models\UserStatus::STATUS_REGIONAL_REPRESENTATIVE])}}"
                                          id="client-status-toggle-form"
                                          data-confirm-message="{{ $user->is_regional_representative ? "Убрать у пользователя {$user->name} ($user->email) статус региональног опредставителя?" : "Установить пользователю {$user->name} ($user->email) статус регионального представителя?" }}">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $user->is_regional_representative ? 'danger' : 'primary' }}">{{ $user->is_regional_representative ? 'Убрать' : 'Установить' }}</button>
                                    </form>
                                </div>
                            </div>

                            <hr>
                        @endif

                        <div class="col-md-6">
                            <div class="admin-content-block">
                                <div class="mb-2">
                                    <strong>Блокировка клиента</strong> <br>{{ $user->name }} ({{ $user->email }})
                                </div>

                                <form method="post"
                                      action="{{route('admin.client.blocked', $id)}}"
                                      @if($user->is_active === 1) id="user-blocked" @else id="user-unblocked" @endif
                                >
                                    @csrf
                                    <button type="submit" class="btn btn-{{ ($user->is_active === 1) ? 'danger' : 'primary' }}">
                                        @if($user->is_active === 1) Заблокировать @else Разблокировать @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Кошельки --}}
                {{-- <div class="tab-pane fade show" id="wallets" role="tabpanel">
                    <div class="admin-content-block">
                        @include('admin.includes.partials.client.wallets')
                    </div>
                </div> --}}

                {{-- Скрины оплат --}}
                {{-- <div class="tab-pane fade show" id="payments" role="tabpanel">
                    <div class="admin-content-block">
                        @include('admin.includes.partials.client.payments')
                    </div>
                </div> --}}

                {{-- Перевод между аккаунтами --}}
                {{-- <div class="tab-pane fade show" id="transfer" role="tabpanel">
                    <div class="admin-content-block">
                        @include('admin.includes.partials.client.transfer')
                    </div>
                </div> --}}
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $('#replenish-balance-form').on('submit', function(e) {
           e.preventDefault();
           if ($('#amount').val().trim() == '') {
                $('#amount').next('.invalid-feedback').text('Пожалуйста заполните это поле. ');
                setTimeout(function(){ $('#amount').next('.invalid-feedback').text('') }, 3000);
                return false;
           }
           var url  = $(this).attr('action');
           $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
               type: "POST",
               url: url,
               data: $('#replenish-balance-form').serialize(),
               success: function( response ) {
                   if (response.error == false) {
                        $('#amount').val('');
                        $('.replenish-success-message').text(response.message);
                        setTimeout(function(){ $('#amount').next('.replenish-success-message').text('') }, 3000);
                   }
               }
           });
       });
         $('#replenish-bonuses-form').on('submit', function(e) {
            e.preventDefault();
            if ($('#bonus').val().trim() == '') {
                 $('#bonus').next('.invalid-feedback').text('Пожалуйста заполните это поле.');
                 setTimeout(function(){ $('#bonus').next('.invalid-feedback').text('') }, 3000);
                 return false;
            }
            var url  = $(this).attr('action');
            $.ajax({
               headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
                type: "POST",
                url: url,
                data: $('#replenish-bonuses-form').serialize(),
                success: function( response ) {
                    if (response.error == false) {
                         $('#amount').val('');
                         $('.replenish-bonuses-success-message').text(response.message);
                         setTimeout(function(){ $('#amount').next('.replenish-bonuses-success-message').text('') }, 3000);
                    }
                }
            });
        });

        document.querySelector('#user-blocked')
            .addEventListener('submit', event => {
                if (!confirm('Заблокировать клиента?')) {
                    event.preventDefault();
                }
            });

        document.querySelector('#user-unblocked')
            .addEventListener('submit', event => {
                if (!confirm('Разблокировать клиента?')) {
                    event.preventDefault();
                }
            });


        document.querySelector('#client-status-toggle-form')
                .addEventListener('submit', function (event) {
                    if (!confirm(this.dataset.confirmMessage)) {
                        event.preventDefault();
                    }
                });

        $(document).ready(function () {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            if (h < 10) {
                h = '0' + h
            }
            if (m < 10) {
                m = '0' + m
            }
            today = yyyy + '-' + mm + '-' + dd + 'T' + h + ':' + m;
            document.getElementById("created_at").value = today;
        });

        function transactionTypeOnChange(id) {
            transaction_type_id = document.getElementById("transaction_type_id")
            amount_crypto = document.getElementById("amount_crypto")
            amount_usd = document.getElementById("amount_usd")
            currency = document.getElementById("currency")
            rate = document.getElementById("rate")
            address = document.getElementById("address")
            additional_data = document.getElementById("additional_data")

            let invest_type_id = {{ \App\Models\Consts\TransactionsTypesConsts::INVEST_TYPE_ID }}
                let
            profit_type_id = {{ \App\Models\Consts\TransactionsTypesConsts::PROFIT_TYPE_ID }}

                let
            withdrawal_type_id = {{ \App\Models\Consts\TransactionsTypesConsts::WITHDRAWAL_TYPE_ID }}

                let
            withdrawal_request_type_id = {{ \App\Models\Consts\TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID }}

                let
            referrals_profit_type_id =
                    {{ json_encode(\App\Models\Consts\TransactionsTypesConsts::ALL_REFERRAL_PROFIT_TYPES) }}

                        let
            bonuses_type_id = {{ json_encode(\App\Models\Consts\TransactionsTypesConsts::BONUSES_TYPE_ID) }}

            // Прибыль от инвестирования или прибыль от рефералов или бонусы
            if ((id == profit_type_id) || ((referrals_profit_type_id.indexOf(parseInt(id))) > 0) || (id == bonuses_type_id)) {
                amount_crypto.disabled = true;
                address.disabled = true;
                additional_data.disabled = true;
                rate.disabled = true;
                currency.disabled = true;
            } else {
                amount_crypto.disabled = false;
                address.disabled = false;
                additional_data.disabled = false;
                rate.disabled = false;
                currency.disabled = false;
            }
        }
    </script>
@endsection
