{{-- Подшаблон "Транзакции" --}}
<div class="container-fluid">
    {{--<div class="head text-center">Все транзакции</div>--}}
        <table class="table2">
            <thead>
            <tr class="no-hover">
                <th>Дата</th>
                <th>Email</th>
                <th>Сумма, USD</th>
                <th>От</th>
                <th>Тип</th>
            </tr>
            </thead>
            <tbody>

            @foreach($transactions as $transaction)
                <tr class="income"> {{-- or withdraw --}}
                    <td aria-label="Дата">
                        {{ $transaction->created_at }}
                    </td>
                    <td aria-label="Email">
                        <a href="{{ route('admin.client', $transaction->user_id) }}">
                            {{ $transaction->user->email }}
                        </a>
                    </td>
                    <td aria-label="Сумма, USD">
                        ${{ number_format(abs($transaction->amount_usd), 2) }}
                    </td>
                    <td aria-label="Email">
                        <a href="{{ route('admin.client', $transaction->user_id) }}">
                            {{ $transaction->editorUser->email }}
                        </a>
                    </td>
                    <td aria-label="Тип">
                        {{ (isset($transaction->currency->name)) ? $transaction->currency->name : '' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    {{-- Пагинация --}}
    {{--<div class="pagination pagination--accurals">
        <a href="#" class="pagination__prev disable">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/>
            </svg>
        </a>

        <a href="#" class="pagination__page is-active">1</a>
        <a href="#" class="pagination__page">2</a>

        <a href="#" class="pagination__next">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/>
            </svg>
        </a>
    </div>--}}

</div>