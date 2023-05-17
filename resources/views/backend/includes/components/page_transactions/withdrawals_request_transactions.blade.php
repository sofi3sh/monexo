{{-- Таблицы транзакций --}}
<div class="base-table base-table_wrapper">
    <table>
        <thead>
            <tr>
                <th>@lang('cabinet_trans.table.system')</th>
                {{-- <th>@lang('cabinet_trans.table.amount_crt')</th> --}}
                <th>@lang('cabinet_trans.table.amount_usd')</th>
                {{-- <th>@lang('cabinet_trans.table.course')</th> --}}
                <th>@lang('cabinet_trans.table.date')</th>
                <th>@lang('cabinet_trans.table.delete')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    {{-- Способ --}}
                    <td aria-label="@lang('cabinet_trans.table.system')">
                        @if(!is_null($transaction->wallet))
                            <span><img src="{{ asset('backend/production/img/currency-icons/gr-' . $transaction->wallet->currency->code . '.png') }}" alt="Multi Wallet"></span>
                        @else
                            <span><img src="{{ asset('backend/production/img/currency-icons/gr-null.png') }}" alt="Multi Wallet"></span>
                        @endif
                    </td>

                    {{-- Сумма в криптовалюте --}}
                    {{-- <td aria-label="@lang('cabinet_trans.table.amount_crt')">
                        @if(!is_null($transaction->wallet))
                            <span>{{ number_format(abs($transaction->amount_crypto), $transaction->wallet->currency->rate_decimal_digits) }}</span>
                        @else
                            <span>-</span>
                        @endif
                    </td> --}}

                    {{-- Сумма в долларах --}}
                    <td aria-label="@lang('cabinet_trans.table.amount_usd')">
                        <span>${{ number_format(abs($transaction->amount_usd), 2) }}</span>
                    </td>

                    {{-- Курс --}}
                    {{-- <td aria-label="@lang('cabinet_trans.table.course')">
                        @if(!is_null($transaction->wallet))
                            <span>{{ number_format($transaction->rate, 2) }}</span>
                        @else
                            <span>-</span>
                        @endif
                    </td> --}}

                    {{-- Дата --}}
                    <td aria-label="@lang('cabinet_trans.table.date')">
                        <span>{{ $transaction->created_at }}</span>
                    </td>

                    {{-- Удаление --}}
                    <td aria-label="@lang('cabinet_trans.table.delete')">
                        <form action="{{ route('home.withdrawal.delete', $transaction->id) }}" method="POST" class="delete_btn">
                            @csrf

                            <button>
                                <span></span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>