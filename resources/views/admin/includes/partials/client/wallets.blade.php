<h4>Сгенерированные пользователем кошельки</h4>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block">
                    <table class="table" id="table">
                        <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-center">Криптовлаюта</th>
                            <th class="text-center">Адрес</th>
                            <th class="text-center">Доп. реквизиты</th>
                            <th class="text-center">Сгенерирован</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($crypto_wallets as $wallet)
                            <tr>
                                <td>{{ $wallet->id }}</td>
                                <td>{{ $wallet->currency->code }}</td>
                                <td class="crypto_wallets-address">
                                    @if(!is_null($wallet->currency->blockchain_addr))
                                        <span style="text-decoration: underline">
                                        <a href="{{ $wallet->currency->blockchain_addr }}{{ $wallet->address }}"
                                           target="_blank">
                                            {{ $wallet->address }}
                                        </a>
                                        </span>
                                    @else
                                        {{ $wallet->address }}
                                    @endif
                                </td>
                                <td class="crypto_wallets-add">{{ $wallet->additional_data }}</td>
                                <td>{{ $wallet->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>