<h3>Заявки на вывод</h3>

{{-- Включить/выключить возможность пользователю создавать заявки на вывод--}}
<div class="col-lg-12">
    <form action="{{ route('admin.revert-can-withdrawal-status', $user->id) }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        @if($user->can_confirm_withdrawal)
            <div class="user-fake-or-real">
                <h4>Статус: <h5 style="color: #4da900">Разрешено создавать</h5></h4>
                <button type="submit" class="login-page__submit login-block__submit button">Запретить</button>
            </div>
        @else
            <div class="user-fake-or-real">
                <h4>Статус: <h5 style="color: #ff0b24">Запрещено создавать</h5></h4>
                <button type="submit" class="login-page__submit login-block__submit button">Разрешить</button>
            </div>
        @endif
    </form>
</div>


<div class="row">
    <div class="col-lg-12">
        <table class="table3">
            <thead>
            <tr>    
                {{-- <th class="text-center">id</th> --}}
                <th class="text-center">Дата создания</th>
                <th class="text-center">Сумма, $ (без ком.)</th>
                <th class="text-center">Сумма, $ (с ком.)</th>
                <th class="text-center">Комиссия, %</th>
                {{--<th class="text-center">Сумма, крипта</th>--}}
                <th class="text-center">Курс</th>
                <th class="text-center">Платежка</th>
                <th class="text-center">Адрес</th>
                <th class="text-center">Доп. реквизиты</th>
                {{--<th class="text-center">Всё</th>--}}

                @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'cryptoman@mail.ru')
                    <th class="text-center">Действие</th>
                @endif
            </tr>
            </thead>
            <tbody>

            @foreach($withdrawal_requests as $withdrawal_request)
                <tr>
                    {{-- <td aria-label="ID">{{ $withdrawal_request->id }}</td> --}}
                    <td aria-label="Дата создания">{{ $withdrawal_request->created_at->format('d-m-Y H:i') }}</td>
                    {{-- Сумма в usd --}}
                    <td aria-label="Сумма, $ (без ком.)">${{ number_format(-$withdrawal_request->amount_usd, 2) }}</td>
                    {{-- Сумма с комиссией --}}
                    <td aria-label="Сумма, $ (с ком.)">
                        ${{ number_format(-$withdrawal_request->amount_usd*(100-$withdrawal_request->commission)/100, 2) }}</td>
                    {{-- Комиссия --}}
                    <td aria-label="Комссия, %"> {{ $withdrawal_request->commission }}</td>
                    {{-- Сумма в крипте --}}
                    {{--<td aria-label="Сумма, крипта">{{ -$withdrawal_request->amount_crypto }} {{ $withdrawal_request->wallet->currency->code }} </td>--}}

                    {{-- Курс --}}
                    <td aria-label="Курс">{{ $withdrawal_request->rate }}</td>

                    {{-- Платежная система --}}
                    <td aria-label="Курс">
                        @if(!is_null($withdrawal_request->wallet))
                            <span><img
                                    src="{{ asset('backend/production/img/currency-icons/gr-' . $withdrawal_request->wallet->currency->code . '.png') }}"
                                    alt="Multi Wallet"
                                    style="width: 30px;"><strong>{{ $withdrawal_request->wallet->currency->name }}</strong></span>
                        @else
                            <span><img src="{{ asset('backend/production/img/currency-icons/gr-null.png') }}"
                                       alt="Multi Wallet"></span>
                        @endif
                    </td>

                    {{-- Адрес --}}
                    <td aria-label="Адрес">
                        <span class="js-copy hint--bottom" aria-label="Скопировать" data-copied="Скопировано"
                              data-clipboard-text="{{ (isset($withdrawal_request->wallet->address)) ? $withdrawal_request->wallet->address : '' }}">
                                        @include('includes.icons.copy')
                                    </span>
                        {{ (isset($withdrawal_request->wallet->address)) ? $withdrawal_request->wallet->address : '' }}
                    </td>
                    {{-- --}}
                    <td aria-label="Доп. реквизиты">
                        @if(isset($withdrawal_request->wallet->additional_data))
                            <span class="js-copy hint--bottom" aria-label="Скопировать"
                                  data-copied="Скопировано"
                                  data-clipboard-text="{{ $withdrawal_request->wallet->additional_data }}">
                                        @include('includes.icons.copy')
                                    </span>
                            {{ $withdrawal_request->wallet->additional_data }}
                        @endif
                    </td>

                    {{-- Всё --}}
                    {{--<td aria-label="Всё">
                            <span class="js-copy hint--bottom" aria-label="Скопировать всё"
                                  data-copied="Скопировано"
                                  data-clipboard-text="{{
                                    'Вывод:' . chr(13) .
                                    $withdrawal_request->user->email . chr(13) .
                                    -$withdrawal_request->amount_crypto . ' ' . $withdrawal_request->wallet->currency->code . chr(13) .
                                    'Адрес: ' . (isset($withdrawal_request->wallet->address)) ? $withdrawal_request->wallet->address : '' .
                                    ((isset($withdrawal_request->wallet->additional_data)) ? (chr(13) . 'Тэг: ' . $withdrawal_request->wallet->additional_data) : '')
                                  }}">
                                        @include('includes.icons.copy')
                                    </span>
                    </td>--}}

                    {{-- Действие --}}

                    @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'cryptoman@mail.ru')
                        <td aria-label="Действие">
                            <div class="input-group mb-3">
                            </div>

                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Действие
                                    </button>
                                    <div class="dropdown-menu">
                                        <form method="POST"
                                              action="{{ route('admin.confirm-withdrawal', $withdrawal_request->id) }}"
                                              class="login-block__form form--register">
                                            @csrf
                                            <button type="submit"
                                                    class="login-page__submit login-block__submit button">
                                                Подтвердить
                                            </button>
                                        </form>

                                        <div role="separator" class="dropdown-divider"></div>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <form method="POST"
                                              action="{{ route('admin.delete-transaction', $withdrawal_request->id) }}"
                                              class="login-block__form form--register">
                                            {{method_field('DELETE')}}
                                            @csrf
                                            <button type="submit"
                                                    class="login-page__submit login-block__submit button"
                                                    style="background-color: #ff0b24">
                                                Удалить
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
