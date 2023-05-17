<div class="row">
    <div class="col-lg-6">
        <div class="stats stats--block">
            <table class="table--border table-main table--not-responsive table--border-grey">
                <tbody>
                <tr>
                    <td width="50%">Email</td>
                    <td>
                        <a href="{{ route('admin.client.login_as_client', $user->id) }}"
                           id="login-as-user-link"
                           class="btn btn-link p-0"
                           title="Авторизоваться">{{ $user->email }}</a>
                    </td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Страна</td>
                    <td>{{ $user->country }}</td>
                </tr>
                <tr>
                    <td>Возраст</td>
                    <td>{{ $user->age }}</td>
                </tr>
                <tr>
                    <td>Телефон</td>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <td>Привел</td>
                    <td>@if(!is_null($user->ancestor()->first()) && $user->ancestor()->first()->id<>1)
                            {{ $user->ancestor()->first()->email }}
                        @endif </td>
                </tr>
                <tr>
                    <td>Зврегистр.</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <td>Язык</td>
                    <td>{{ $user->locale }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="stats stats--block">
            <table class="table--border table-main table--not-responsive table--border-grey">
                <tr>
                    <td>Баланс USD @if($user->withdrawal_request_usd>0) (за вычетом заявок на вывод)@endif</td>
                    <td>${{ $user->balance_usd }}</td>
                </tr>
                <tr>
                    <td>Баланс BTC</td>
                    <td>BTC {{ $user->balance_btc }}</td>
                </tr>
                <tr>
                    <td>Баланс ETH</td>
                    <td>ETH {{ $user->balance_eth }}</td>
                </tr>
                <tr>
                    <td>Баланс PZM</td>
                    <td>PZM {{ $user->balance_pzm }}</td>
                </tr>
                <tr>
                    <td>Ввел</td>
                    <td>${{number_format($user->allReplenishment(), 2)}}</td>
                </tr>
                <tr>
                    <td>Прибыль от инвестиций</td>
                    <td>${{ $user->profit_usd }}</td>
                </tr>
                <tr>
                    <td>Прибыль от рефералов</td>
                    <td>${{ $user->referrals_usd }}</td>
                </tr>
                <tr>
                    <td>Вывел</td>
                    <td>${{number_format(-$user->allWithdrawal(), 2)}}</td>
                </tr>
                <tr>
                    <td>Заявки на вывод</td>
                    <td>${{ $user->withdrawal_request_usd }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

{{-- Реквизиты пользователя --}}
<div class="row">
    <div class="col-lg-6">
        <div class="stats stats--block">
            <b>Реквизиты:</b>
            <table class="table--border table-main table--not-responsive table--border-grey">
                <tr>
                    <td>Банковская карта</td>
                    <td>{{ $user->visa }}</td>
                </tr>
                <tr>
                    <td>Perfect Money</td>
                    <td>{{ $user->mastercard }}</td>
                </tr>
                <tr>
                    <td>Qiwi</td>
                    <td>{{ $user->qiwi }}</td>
                </tr>
                <tr>
                    <td>Payeer</td>
                    <td>{{ $user->webmoney }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Статистика по активному плану --}}
    <div class="col-lg-6">
        <div class="stats stats--block">
            <b>Статистика по активному плану:</b>
            <table class="table--border table-main table--not-responsive table--border-grey">
                @if(!is_null($user->getUserMarketingPlan()))
                    <tr>
                        <td>Дата начала:</td>
                        <td>{{ $user->getUserMarketingPlan()->start_at }}</td>
                    </tr>
                    {{-- Инвестировано --}}
                    <tr>
                        <td>Инвестировано:</td>
                        <td>${{ $user->getUserMarketingPlan()->invested_usd }}</td>
                    </tr>
                    {{-- Прибыль --}}
                    <tr>
                        <td>Прибыль:</td>
                        <td>${{ $user->getUserMarketingPlan()->profit_usd }}</td>
                    </tr>
                    {{-- Партнерские --}}
                    <tr>
                        <td>Партнерские:</td>
                        <td>${{ $user->getUserMarketingPlan()->partner_profit_usd }}</td>
                    </tr>
                    {{-- Agio Token --}}
                    <tr>
                        <td>Agio Token:</td>
                        <td>${{ $user->getUserMarketingPlan()->coin_usd }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Дата начала:</td>
                        <td>-</td>
                    </tr>
                    {{-- Инвестировано --}}
                    <tr>
                        <td>Инвестировано:</td>
                        <td>-</td>
                    </tr>
                    {{-- Прибыль --}}
                    <tr>
                        <td>Прибыль:</td>
                        <td>-</td>
                    </tr>
                    {{-- Партнерские --}}
                    <tr>
                        <td>Партнерские:</td>
                        <td>-</td>
                    </tr>
                    {{-- Agio Token --}}
                    <tr>
                        <td>Agio Token:</td>
                        <td>-</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>

<div class="container">
    {{-- Верифицировать email --}}
    <div class="row">
        <div class="col-lg-12">
            {{--{{ dd($user->id) }}--}}
            @if(!$user->email_verified_at)
                <form action="{{ route('admin.email-verified', $user->id) }}" method="POST">
                    @csrf
                    <div class="input-row">
                        <button type="submit" class="button button--middle">Верифицировать Email</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        {{-- Сделать фейковым/реальным --}}
        <div class="col-lg-12">
            <form action="{{ route('admin.change-fake', $user->id) }}" method="POST">
                @csrf
                @if($user->fake)
                <div class="user-fake-or-real">
                    <h4>Статус: <h5 style="color: #221bd6">Фейк</h5></h4>
                    <button type="submit" class="login-page__submit login-block__submit button">Сделать реальным</button>
                </div>
                @else
                <div class="user-fake-or-real">
                    <h4>Статус: <h5 style="color: #221bd6">Реальный</h5></h4>
                    <button type="submit" class="login-page__submit login-block__submit button">Сделать фейковым</button>
                </div>
                @endif
            </form>
        </div>
        <div class="col-lg-8">
            <form action="{{ route('admin.change-ancestor') }}" method="POST">
                @csrf
                {{-- Скрытые поля --}}
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="admin--move_under">
                    <div class="move_under-block">
                        <label for="move_under">Поместить под:</label>
                        <input type="text" name="move_under" required class="form-control" placeholder="email">
                    </div>
                    <button type="submit" class="login-page__submit login-block__submit button">Подтвердить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('#login-as-user-link')
            .addEventListener('click', event => {
                if (!confirm('Авторизоваться?')) {
                    event.preventDefault();
                }
            });
</script>
