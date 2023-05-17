@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block admin-content-block--no-table-radius">
                    <h3>Заявки на криптовалюты</h3>

                    @include('includes.partials.messages')

                    <table class="table" id="table">
                        <thead>
                        <tr>
                            {{-- <th class="text-center">id</th> --}}
                            <th class="text-center">Дата создания</th>
                            <th class="text-center">email</th>
                            <th class="text-center">Сумма, крипта</th>
                            <th class="text-center">Cистема</th>
                            <th class="text-center">Адрес</th>
                            <th class="text-center">Курс</th>
                            {{-- <th class="text-center">Всё</th> --}}
                                <th class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($crypto_requests as $crypto)
                            <tr>
                                {{-- <td aria-label="id">{{ $crypto->id }}</td> --}}
                                <td aria-label="Дата создания">{{ $crypto->created_at->format('d-m-Y H:i') }}</td>
                                <td aria-label="email">
                                    <a href="{{ route('admin.client', $crypto->user_id) }}">
                                        {{ $crypto->user->email }}
                                    </a>
                                </td>
                                {{-- Сумма в крипте --}}
                                <td aria-label="Сумма, крипта">{{ $crypto->amount_crypto }} {{ $crypto->wallet->currency->code }} </td> 

                                

                                {{-- Платежная система --}}
                                <td aria-label="Cистема">
                                    @if(!is_null($crypto->wallet))
                                        <span><strong>{{ $crypto->wallet->currency->name }}</strong></span>
                                    @else
                                        <span><img src="{{ asset('backend/production/img/currency-icons/gr-null.png') }}" alt="Multi Wallet"></span>
                                    @endif
                                </td>

                                {{-- Адрес --}}
                                <td aria-label="Адрес">
                                    <span class="js-copy hint--bottom" aria-label="Скопировать" data-copied="Скопировано"
                                          data-clipboard-text="{{ (isset($crypto->wallet->address)) ? $crypto->wallet->address : '' }}">
                                                    @include('includes.icons.copy')
                                                </span>
                                    {{ (isset($crypto->wallet->address)) ? $crypto->wallet->address : '' }}
                                </td>
                                {{-- Доп. рекв. --}}
                                <td aria-label="Курс">${{number_format($crypto->rate, 2)}}</td>

                                {{-- Всё --}}
                                {{-- <td aria-label="Всё">
                                        <span class="js-copy hint--bottom" aria-label="Скопировать всё"
                                              data-copied="Скопировано"
                                              data-clipboard-text="{{
                                                'Вывод:' . chr(13) .
                                                $crypto->user->email . chr(13) .
                                                -$crypto->amount_crypto . ' ' . $crypto->wallet->currency->code . chr(13) .
                                                'Адрес: ' .  (isset($crypto->wallet->address)) ? $crypto->wallet->address : ''  .
                                                ((isset($crypto->wallet->additional_data)) ? (chr(13) . 'Тэг: ' . $crypto->wallet->additional_data) : '')
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
                                                            action="{{ route('admin.confirm-crypto', $crypto->id) }}"
                                                            class="login-block__form form--register">
                                                        @csrf
                                                        <button type="submit"
                                                                class="login-page__submit login-block__submit button">
                                                            Подтвердить
                                                        </button>
                                                    </form>

                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <form method="POST" action="{{ route('admin.delete-confirm-crypto', $crypto->id) }}"
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
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection