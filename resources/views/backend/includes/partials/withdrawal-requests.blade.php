@if (count($view_model->withdrawal_requests)>0)

    {{-- Title --}}
    <div class="investment-title text-center">
        <h2>{{ __('strings.backend.withdrawals.queue') }}</h2>
    </div>

    {{-- Table --}}
    <div class="gr-pgn-transactions-wrapper" data-lang-search="Search">
        <table class="transactions-ns-model transactions-ns-model-adaptive">
            <thead class="tnsm-header">
                <tr>
                    <th class="first">{{ __('strings.backend.withdrawals.date') }}<span class="up active">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="second">{{ __('strings.backend.transactions.sum_crypto') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="third">{{ __('strings.backend.transactions.sum_usd') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="fourth">{{ __('strings.backend.withdrawals.wallet') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="fifth">{{ __('strings.backend.withdrawals.wallet_tag') }}<span class="up">&#9650;</span><span class="down">&#9660;</span></th>
                    <th class="fifth">Отмена заявки</th>
                </tr>
            </thead>
            <tbody class="tnsm-body">
                @foreach($view_model->withdrawal_requests as $withdrawal_request)
                    <tr>
                        <td class="tnsm--time" data-tnsm--time="{{ $withdrawal_request->created_at }}" data-tnsm--sort="{{ $withdrawal_request->created_at }}">
                            <div class="time tnsm-block">
                                <h2>00:00</h2>
                                <small>2019-01-01</small>
                            </div>
                        </td>
                        <td class="tnsm--сrypto" aria-label="{{ __('strings.backend.transactions.sum_crypto') }}" data-tnsm--crypto="{{ $withdrawal_request->wallet->currency->code }}" data-tnsm--crypto-sum="{{ number_format(-$withdrawal_request->amount_crypto, $withdrawal_request->wallet->currency->rate_decimal_digits) }}" data-tnsm--sort="{{ number_format(-$withdrawal_request->amount_crypto, $withdrawal_request->wallet->currency->rate_decimal_digits) }}">
                            <div class="sum-cr tnsm-block">
                                <div class="logo">
                                    <img src="../backend/img/gr-table-icons/gr-{{ $withdrawal_request->wallet->currency->code }}.png" alt="">
                                </div>
                                <div class="content">
                                    <h2>{{ $withdrawal_request->wallet->currency->code }}</h2>
                                    <small>{{ number_format(-$withdrawal_request->amount_crypto, $withdrawal_request->wallet->currency->rate_decimal_digits) }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="tnsm--usd" aria-label="{{ __('strings.backend.transactions.sum_usd') }}" data-tnsm--usd-sum="{{ number_format(-$withdrawal_request->amount_usd, 2 ) }}" data-tnsm--sort="{{ number_format(-$withdrawal_request->amount_usd, 2 ) }}">
                            <div class="sum-usd tnsm-block">
                                <div class="logo">
                                    <img src="../backend/img/gr-table-icons/trans-tn-usd-s.jpg" alt="">
                                </div>
                                <div class="content">
                                    <h2>USD</h2>
                                    <small>{{ number_format(-$withdrawal_request->amount_usd, 2 ) }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="tnsm--rate" aria-label="{{ __('strings.backend.withdrawals.wallet') }}" data-tnsm--rate-sum="{{ $withdrawal_request->wallet->address }}" data-tnsm--sort="{{ $withdrawal_request->wallet->address }}">
                            <div class="rate tnsm-block">
                                <div class="logo">
                                    <img src="../backend/img/gr-table-icons/trans-tn-rate-s.jpg" alt="">
                                </div>
                                <div class="content">
                                    <h2>{{ __('strings.backend.withdrawals.wallet') }}</h2>
                                    <small>{{ $withdrawal_request->wallet->address }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="tnsm--type" aria-label="{{ __('strings.backend.withdrawals.wallet_tag') }}" data-tnsm--type="{{ $withdrawal_request->wallet->additional_data }}" data-tnsm--sort="{{ $withdrawal_request->wallet->additional_data }}">
                            <div class="type tnsm-block">
                                <div class="logo">
                                    <img src="../backend/img/gr-table-icons/trans-tn-type-s.jpg" alt="">
                                </div>
                                <div class="content">
                                    <h2>{{ $withdrawal_request->wallet->additional_data }}</h2>
                                </div>
                            </div>
                        </td>
                        <td class="tnsm--delete" aria-label="{{ __('strings.backend.withdrawals.wallet_tag') }}">
                            <form action="{{ route('home.withdrawal.delete', $withdrawal_request->id) }}" method="POST">
                                @csrf
                                <button>
                                    <span>Удалить</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif