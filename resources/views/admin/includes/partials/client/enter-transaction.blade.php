
            <h4>Только вводы</h4>
            <div class="container-fluid">
                {{--<div class="head text-center">Все транзакции</div>--}}
                <table class="table3">
                    <thead>
                    <tr class="no-hover">
                        <th>id</th>
                        <th>Дата</th>
                        <th>Работает до</th>
                        <th>Сумма, USD</th>
                        <th>Сумма, криптовалюта</th>
                        <th>Курс</th>
                        @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'cryptoman@mail.ru')
                            <th>Действие</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($invests as $transaction)
                        <tr class="income"> {{-- or withdraw --}}
                            <td aria-label="id">
                                {{ $transaction->id }}
                            </td>
                            <td aria-label="Дата">
                                {{ $transaction->created_at }}
                            </td>
                            <td aria-label="Работает до">
                                {{ $transaction->end_period }}
                            </td>
                            <td aria-label="Сумма, USD">
                                ${{ number_format(abs($transaction->amount_usd), 2) }}
                            </td>

                            <td aria-label="Сумма, криптовалюта">
                                @if(!is_null($transaction->wallet))
                                    {{ number_format(abs($transaction->amount_crypto), $transaction->wallet->currency->rate_decimal_digits) }}
                                    {{ $transaction->wallet->currency->code }}
                                @endif
                            </td>
                            <td aria-label="Курс, USD">
                                @if(!is_null($transaction->wallet))
                                    ${{ number_format($transaction->rate, 2) }}
                                @endif
                            </td>

                            @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'cryptoman@mail.ru')
                                <td aria-label="Действие">
                                    <form action="{{ route('admin.delete-transaction', $transaction->id) }}" method="POST">
                                        {{method_field('DELETE')}}
                                        @csrf
                                        <button type="submit" class="login-page__submit login-block__submit button">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>