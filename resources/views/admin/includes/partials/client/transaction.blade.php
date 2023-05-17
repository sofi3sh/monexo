<h3>Транзакции</h3>
<div class="container-fluid">
    {{--<div class="head text-center">Все транзакции</div>--}}
    <table class="table3">
        <thead>
            <tr class="no-hover">
                <th>id</th>
                <th>Сумма, USD</th>
                <th>Баланс после операции</th>
                <th>Комиссия (% / $)</th>
                <th>Тип</th>
                <th>Дата</th>
                @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'cryptoman@mail.ru')
                    <th class="text-center">Действие</th>
                @endif
            </tr>
        </thead>
        <tbody>

        @foreach($transactions as $transaction)
            <tr class="income"> {{-- or withdraw --}}
                <td aria-label="ID">
                    {{ $transaction->id }}
                </td>
                
                <td aria-label="Сумма, USD">
                    ${{ number_format(abs($transaction->amount_usd), 2) }}
                </td>

                <td aria-label="Баланс после операции">
                    {{ $transaction->balance_usd_after_transaction}}
                </td>

                
                <td aria-label="Комиссия">
                    {{ $transaction->commission}}
                </td>



                {{-- <td aria-label="Сумма, криптовалюта">
                    @if(!is_null($transaction->wallet))
                        {{ number_format(abs($transaction->amount_crypto), $transaction->wallet->currency->rate_decimal_digits) }}
                        {{ $transaction->wallet->currency->code }}
                    @endif
                </td>
                <td aria-label="Курс, USD">
                    @if(!is_null($transaction->wallet))
                        ${{ number_format($transaction->rate, 2) }}
                    @endif
                </td> --}}

                <td aria-label="Тип">
                    {{ $transaction->transactionType->transactionTypeName() }}
                </td>
                
                

                <td aria-label="Дата">
                    {{ $transaction->created_at }}
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