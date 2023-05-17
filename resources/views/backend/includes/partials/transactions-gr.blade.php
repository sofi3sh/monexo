{{-- Подшаблон "Транзакции в новом стиле" страницы "Транзакции" --}}
<div class="container-fluid">
    {{--<div class="head text-center">Все транзакции</div>--}}
    <div class="gr-pgn-transactions-wrapper" data-lang-search="Search">
        <table class="transactions-ns-model transactions-ns-model-adaptive">
            <thead class="tnsm-header">
                <tr>
                    <th class="first">{{ __('strings.backend.transactions.date') }}<span class="up active">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="second">{{ __('strings.backend.transactions.sum_crypto') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="third">{{ __('strings.backend.transactions.sum_usd') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="fourth">{{ __('strings.backend.transactions.rate') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="fifth">{{ __('strings.backend.transactions.type') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                </tr>
            </thead>
            <tbody class="tnsm-body">
                @foreach($transactions as $transaction)
                    <tr>{{-- or withdraw --}}
                        <td class="tnsm--time" data-tnsm--time="{{ $transaction->created_at }}" data-tnsm--sort="{{ $transaction->created_at }}">
                            <div class="time tnsm-block">
                                <h2>00:00</h2>
                                <small>2019-01-01</small>
                            </div>
                        </td>
                        @if(!is_null($transaction->wallet))
                            <td class="tnsm--сrypto" aria-label="{{ __('strings.backend.transactions.sum_crypto') }}" data-tnsm--crypto="{{ $transaction->wallet->currency->code }}" data-tnsm--crypto-sum="{{ number_format(abs($transaction->amount_crypto), $transaction->wallet->currency->rate_decimal_digits) }}" data-tnsm--sort="{{ number_format(abs($transaction->amount_crypto), $transaction->wallet->currency->rate_decimal_digits) }}">
                                <div class="sum-cr tnsm-block">
                                    <div class="logo">
                                        <img src="../backend/img/gr-table-icons/gr-{{ __('strings.backend.transactions.sum_crypto') }}.png" alt="">
                                    </div>
                                    <div class="content">
                                        <h2>{{ $transaction->wallet->currency->code }}</h2>
                                        <small>{{ number_format(abs($transaction->amount_crypto), $transaction->wallet->currency->rate_decimal_digits) }}</small>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td class="tnsm--сrypto" aria-label="{{ __('strings.backend.transactions.sum_crypto') }}" data-tnsm--crypto="-" data-tnsm--crypto-sum="" data-tnsm--sort="0">
                                <div class="sum-cr tnsm-block">
                                    <div class="logo">
                                        <img src="../backend/img/gr-table-icons/gr-.png" alt="">
                                    </div>
                                    <div class="content">
                                        <h2>-</h2>
                                        <small></small>
                                    </div>
                                </div>
                            </td>
                        @endif
                        <td class="tnsm--usd" aria-label="{{ __('strings.backend.transactions.sum_usd') }}" data-tnsm--usd-sum="{{ number_format(abs($transaction->amount_usd), 2) }}" data-tnsm--sort="{{ number_format(abs($transaction->amount_usd), 2) }}">
                            <div class="sum-usd tnsm-block">
                                <div class="logo">
                                    <img src="../backend/img/gr-table-icons/trans-tn-usd-s.jpg" alt="">
                                </div>
                                <div class="content">
                                    <h2>USD</h2>
                                    <small>{{ number_format(abs($transaction->amount_usd), 2) }}</small>
                                </div>
                            </div>
                        </td>
                        @if(!is_null($transaction->wallet))
                            <td class="tnsm--rate" aria-label="{{ __('strings.backend.transactions.rate') }}" data-tnsm--rate-sum="{{ number_format($transaction->rate, 2) }}" data-tnsm--sort="{{ number_format($transaction->rate, 2) }}">
                                <div class="rate tnsm-block">
                                    <div class="logo">
                                        <img src="../backend/img/gr-table-icons/trans-tn-rate-s.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <h2>USD</h2>
                                        <small>{{ number_format($transaction->rate, 2) }}</small>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td class="tnsm--rate" aria-label="{{ __('strings.backend.transactions.rate') }}" data-tnsm--rate-sum="" data-tnsm--sort="0">
                                <div class="rate tnsm-block">
                                    <div class="logo">
                                        <img src="../backend/img/gr-table-icons/trans-tn-rate-s.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <h2>-</h2>
                                        <small></small>
                                    </div>
                                </div>
                            </td>
                        @endif
                        <td class="tnsm--type" aria-label="{{ __('strings.backend.transactions.type') }}" data-tnsm--type="{{ $transaction->transactionType->transactionTypeName() }}" data-tnsm--sort="{{ $transaction->transactionType->transactionTypeName() }}">
                            <div class="type tnsm-block">
                                <div class="logo">
                                    <img src="../backend/img/gr-table-icons/trans-tn-type-s.jpg" alt="">
                                </div>
                                <div class="content">
                                    <h2>-</h2>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>