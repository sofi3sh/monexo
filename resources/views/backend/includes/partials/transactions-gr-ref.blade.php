{{-- Подшаблон "Транзакции в новом стиле" страницы "Транзакции" --}}
<div class="container-fluid">
    {{--<div class="head text-center">Все транзакции</div>--}}
    <div class="gr-pgn-transactions-wrapper" data-lang-search="Search">
        <table class="transactions-ns-model transactions-ns-model-adaptive">
            <thead class="tnsm-header">
                <tr>
                    <th class="first">{{ __('strings.backend.transactions.date') }}<span class="up active">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="second">{{ __('strings.backend.transactions.who') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="third">{{ __('strings.backend.transactions.sum_usd') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="fourth">{{ __('strings.backend.transactions.email') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
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
                            <td class="tnsm--user" aria-label="{{ __('strings.backend.transactions.who') }}" data-tnsm--user="{{ __('strings.backend.transactions.refer') }}" data-tnsm--user-type="{{ __('strings.backend.transactions.refer-type') }}" data-tnsm--sort="{{ __('strings.backend.transactions.refer') }}">
                                <div class="user tnsm-block">
                                    <div class="logo">
                                        <span></span>
                                    </div>
                                    <div class="content">
                                        <h2>{{ __('strings.backend.transactions.refer') }}</h2>
                                        <small>{{ __('strings.backend.transactions.refer-type') }}</small>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td class="tnsm--user" aria-label="{{ __('strings.backend.transactions.who') }}" data-tnsm--user="{{ __('strings.backend.transactions.refer') }}" data-tnsm--user-type="{{ __('strings.backend.transactions.refer-type') }}" data-tnsm--sort="{{ __('strings.backend.transactions.refer') }}">
                                <div class="user tnsm-block">
                                    <div class="logo">
                                        <span></span>
                                    </div>
                                    <div class="content">
                                        <h2>{{ __('strings.backend.transactions.refer') }}</h2>
                                        <small>{{ __('strings.backend.transactions.refer-type') }}</small>
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
                            <td class="tnsm--email" aria-label="{{ __('strings.backend.transactions.email') }}" data-tnsm--email="{{ __('strings.backend.transactions.email-hide') }}" data-tnsm--sort="{{ __('strings.backend.transactions.email-hide') }}">
                                <div class="email tnsm-block">
                                    <div class="logo">
                                        <img src="img/icon/trans-tn-email-s.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <h2>E-mail</h2>
                                        <small>{{ __('strings.backend.transactions.email-hide') }}</small>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td class="tnsm--email" aria-label="{{ __('strings.backend.transactions.email') }}" data-tnsm--email="{{ __('strings.backend.transactions.email-hide') }}" data-tnsm--sort="{{ __('strings.backend.transactions.email-hide') }}">
                                <div class="email tnsm-block">
                                    <div class="logo">
                                        <img src="../backend/img/gr-table-icons/trans-tn-email-s.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <h2>E-mail</h2>
                                        <small>{{ __('strings.backend.transactions.email-hide') }}</small>
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