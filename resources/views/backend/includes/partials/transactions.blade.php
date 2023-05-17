{{-- Подшаблон "Все транзакции" страницы "Транзакции" --}}
<div class="container-fluid">
    {{--<div class="head text-center">Все транзакции</div>--}}
    <div class="table-wrap table-wrap--block table-wrap--block-sml-bg gaosdka">
        <table class="table table-pag table--text table--accurals table--internal-border">
            <thead>
            <tr class="no-hover">
                <th>{{ __('strings.backend.transactions.date') }}</th>
                <th>{{ __('strings.backend.transactions.sum_usd') }}</th>
                <th>{{ __('strings.backend.transactions.sum_crypto') }}</th>
                <th>{{ __('strings.backend.transactions.rate') }}</th>
                <th>{{ __('strings.backend.transactions.type') }}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($transactions as $transaction)
                <tr class="income"> {{-- or withdraw --}}
                    <td aria-label="{{ __('strings.backend.transactions.date') }}">
                        {{ $transaction->created_at }}
                    </td>
                    <td aria-label="{{ __('strings.backend.transactions.sum_usd') }}">
                        ${{ number_format(abs($transaction->amount_usd), 2) }}
                    </td>

                    <td aria-label="{{ __('strings.backend.transactions.sum_crypto') }}">
                        @if(!is_null($transaction->wallet))
                            {{ number_format(abs($transaction->amount_crypto), $transaction->wallet->currency->rate_decimal_digits) }}
                            {{ $transaction->wallet->currency->code }}
                        @endif
                    </td>
                    <td aria-label="{{ __('strings.backend.transactions.rate') }}">
                        @if(!is_null($transaction->wallet))
                            ${{ number_format($transaction->rate, 2) }}
                        @endif
                    </td>

                    <td aria-label="{{ __('strings.backend.transactions.type') }}">
                        {{ $transaction->transactionType->transactionTypeName() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

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