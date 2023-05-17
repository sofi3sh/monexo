@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block">
                    <table class="table" id="table">
                        <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-center">email</th>
                            <th class="text-center">Баланс</th>
                            <th class="text-center">Инвестировал</th>
                            <th class="text-center">Заработал на депоз.</th>
                            <th class="text-center">Заработал на рефералах</th>
                            <th class="text-center">Вывел</th>
                            <th class="text-center">Заявка на вывод</th>
                            {{--<th class="text-center">Кто привел</th>--}}
                            {{--<th class="text-center">Админ</th>--}}
                            <th class="text-center">Зарегистр.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr @if($client->is_active === 0)class="is_active_false"@endif>
                                <td aria-label="id">{{ $client->id }}</td>
                                <td aria-label="email" {{--style="text-decoration: underline;"--}}>
                                    <a href="{{ route('admin.client', $client->id) }}">
                                        {{ $client->email }}
                                    </a>
                                </td>
                                <td aria-label="Баланс">{{ $client->balance_usd }}</td>
                                <td aria-label="Инвестировал">{{ $client->invested_usd }}</td>
                                <td aria-label="Заработал на депоз.">{{ $client->profit_usd }}</td>
                                <td aria-label="Заработал на рефералах">{{ $client->referrals_usd }}</td>
                                <td aria-label="Вывел">{{ number_format(-$client->withdrawal_usd, 2) }}</td>
                                <td aria-label="Заявка на вывод">{{ number_format(-$client->withdrawal_request_usd, 2) }}</td>
                                {{--<td style="text-decoration: underline;">
                                    --}}{{--{{ dd($client->ancestor()->first()) }}--}}{{--
                                    --}}{{--@if($client->ancestor())
                                        <a href="{{ route('admin.client', $client->ancestor()->id) }}">
                                            {{ $client->ancestor()->first()->email }}
                                        </a>
                                    @endif--}}{{--
                                </td>--}}
                                {{--<td>{{ $client->admin }}</td>--}}
                                <td aria-label="Зарегистр.">{{ $client->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <style>
        .is_active_false {
            font-weight: bold !important;
        }
    </style>
@endsection
