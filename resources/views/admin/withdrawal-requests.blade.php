@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block admin-content-block--no-table-radius">
                    <div class="row">
                        <div class="col-sm-10">
                            <h3>Заявки на вывод</h3>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{route('admin.withdrawal-requests-all')}}" class="btn btn-info" role="button">Быстрый вывод</a>
                        </div>
                    </div>

                    @include('includes.partials.messages')

                    <table class="table1" id="table">
                        <thead>
                        <tr>
                            {{-- <th class="text-center">id</th> --}}
                            <th class="text-center">Дата создания</th>
                            <th class="text-center">email</th>
                            <th class="text-center">Сумма, $</th>
                            {{-- <th class="text-center">Сумма, крипта</th> --}}
                            <th class="text-center">Комиссия</th>
                            <th class="text-center">Cистема</th>
                            <th class="text-center">Адрес</th>
                            {{-- <th class="text-center">Доп. реквизиты</th> --}}
                            {{-- <th class="text-center">Всё</th> --}}
                                <th class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdrawal_requests as $withdrawal_request)
                            <tr>
                                {{-- <td aria-label="id">{{ $withdrawal_request->id }}</td> --}}
                                <td aria-label="Дата создания">{{ $withdrawal_request->created_at->format('d-m-Y H:i') }}</td>
                                <td aria-label="email">
                                    <a href="{{ route('admin.client', $withdrawal_request->user_id) }}">
                                        {{ $withdrawal_request->user->email }}
                                    </a>
                                </td>
                                {{-- Сумма в usd --}}
                                @php
                                    $codeAmount = (isset($withdrawal_request->currency->code) && $withdrawal_request->currency->code != 'USDT') ? 'amount_'.strtolower($withdrawal_request->currency->code) : 'amount_usd';
                                    $withdrawal_request->$codeAmount = $withdrawal_request->$codeAmount < 0 ? $withdrawal_request->$codeAmount*-1 : $withdrawal_request->$codeAmount;
                                @endphp
                                <td aria-label="Сумма, $">{{(isset($withdrawal_request->currency->code)) ? $withdrawal_request->currency->code : ''}} {{$withdrawal_request->$codeAmount+$withdrawal_request->commission}}</td>
                                {{-- Сумма в крипте --}}
                                {{-- <td aria-label="Сумма, крипта">{{ -$withdrawal_request->amount_crypto }} {{ $withdrawal_request->wallet->currency->code }} </td> --}}

                                {{-- Курс --}}
                                <td aria-label="Курс">{{(isset($withdrawal_request->currency->code)) ? $withdrawal_request->currency->code : ''}} {{ $withdrawal_request->commission }}</td>

                                {{-- Платежная система --}}
                                <td aria-label="Cистема">
                                    @if(!is_null($withdrawal_request->wallet))
                                        <span><strong>{{ $withdrawal_request->wallet->currency->name }}</strong></span>
                                    @else
                                        <span><img src="{{ asset('backend/production/img/currency-icons/gr-null.png') }}" alt="Multi Wallet"></span>
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
                                {{-- Доп. рекв. --}}
                               {{--  <td aria-label="Доп. реквизиты">
                                    @if(isset($withdrawal_request->wallet->additional_data))
                                        <span class="js-copy hint--bottom" aria-label="Скопировать"
                                              data-copied="Скопировано"
                                              data-clipboard-text="{{ $withdrawal_request->wallet->additional_data }}">
                                                    @include('includes.icons.copy')
                                                </span>
                                        {{ $withdrawal_request->wallet->additional_data }}
                                    @endif
                                </td> --}}

                                {{-- Всё --}}
                                {{-- <td aria-label="Всё">
                                        <span class="js-copy hint--bottom" aria-label="Скопировать всё"
                                              data-copied="Скопировано"
                                              data-clipboard-text="{{
                                                'Вывод:' . chr(13) .
                                                $withdrawal_request->user->email . chr(13) .
                                                -$withdrawal_request->amount_crypto . ' ' . $withdrawal_request->wallet->currency->code . chr(13) .
                                                'Адрес: ' .  (isset($withdrawal_request->wallet->address)) ? $withdrawal_request->wallet->address : ''  .
                                                ((isset($withdrawal_request->wallet->additional_data)) ? (chr(13) . 'Тэг: ' . $withdrawal_request->wallet->additional_data) : '')
                                              }}">
                                                    @include('includes.icons.copy')
                                                </span>
                                </td> --}}

                                {{-- --}}

                                    <td aria-label="Действие">
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
                                                    <form method="POST" action="{{ route('admin.delete-confirm-withdrawal', $withdrawal_request->id) }}"
                                                            class="login-block__form form--register">
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
                            </tr>
                            @if($withdrawal_request->name)
                                @php($metaTransaction = @json_decode($withdrawal_request->name, true))
                                <tr>
                                    @if ($metaTransaction && isset($metaTransaction['crypto_details']))
                                        @php($metaCD = $metaTransaction['crypto_details'])
                                        @if ($metaCD['memo'])
                                        <td colspan="7" aria-label="Комментарий (MEMO)" style="text-align: left">
                                            <strong>Комментарий (MEMO):</strong><br>
                                            <span class="js-copy hint--bottom"
                                                  aria-label="Скопировать"
                                                  data-copied="Скопировано"
                                                  data-clipboard-text="{{ $metaCD['memo'] }}">
                                                    @include('includes.icons.copy')
                                            </span>
                                            {{ $metaCD['memo'] }}
                                        </td>
                                        @endif
                                    @else
                                    <td colspan="7" aria-label="Данные карты" style="text-align: left">
                                        <strong>Данные владельца карты:</strong><br>
                                        @if($metaTransaction)
                                            @php($metaCD = $metaTransaction['card_details'])
                                            <span class="js-copy hint--bottom" aria-label="Скопировать" data-copied="Скопировано"
                                                  data-clipboard-text="{{ $metaCD['surname'] }} {{ $metaCD['name'] }} {{ $metaCD['patronymic'] }}">
                                                @include('includes.icons.copy')
                                            </span>
                                            <strong>ФИО</strong>
                                            {{ $metaCD['surname'] }}
                                            {{ $metaCD['name'] }}
                                            {{ $metaCD['patronymic'] }}
                                            <span class="js-copy hint--bottom" aria-label="Скопировать" data-copied="Скопировано" data-clipboard-text="{{ $metaCD['number'] }}">
                                                @include('includes.icons.copy')
                                            </span>
                                            <strong>ИНН</strong>
                                            {{ $metaCD['number'] }}
                                            <span class="js-copy hint--bottom" aria-label="Скопировать" data-copied="Скопировано" data-clipboard-text="{{ $metaCD['phone'] }}">
                                                @include('includes.icons.copy')
                                            </span>
                                            <strong>Телефон</strong>
                                            {{ $metaCD['phone'] }}
                                        @else
                                            {{ $withdrawal_request->name }}
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
