@extends('layouts.monitoring')

@section('content')
    <form action="{{ route('monitoring.main') }}" method="GET">
        {{--@csrf--}}
        <div class="container-fluid" style="padding-top: 2em">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2">
                    <p>Начало: <input name="start" value="{{ $start }}" type="text" id="datepicker1"></p>
                </div>
                <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2">
                    <p>Окончание: <input name="end" value="{{ $end }}" type="text" id="datepicker2"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-2 col-xl-1">
                    <p>
                        <button type="submit" class="btn-info">Сформировать</button>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="admin-content-block">
                        <h4>Доход (инвестировано минус выплачено):
                            {{($profit<0) ? '-' : '' }}
                            ${{ number_format(abs($profit), 0, $dec_point = ".", $thousands_sep = " " ) }}</h4>
                        <h4>Всего инвестировано:
                            ${{ number_format($invested, 0, $dec_point = ".", $thousands_sep = " " ) }}</h4>
                        <h4>Всего выплачено:
                            ${{ number_format($withdrawals, 0, $dec_point = ".", $thousands_sep = " " ) }}</h4>
                        {{--<h4>Максимальная инвестиция:
                            ${{ number_format($max_invested, 0, $dec_point = ".", $thousands_sep = " " ) }}</h4>
                        <h4>Минимальная инвестиция:
                            ${{ number_format($min_invested, 0, $dec_point = ".", $thousands_sep = " " ) }}</h4>--}}
                        <h4>Количество зарегистрированных за период:
                            {{ number_format($reg_count, 0, $dec_point = ".", $thousands_sep = " " ) }}</h4>
                    </div>
                </div>
            </div>
            <hr>
            {{-- Вводы --}}
            <div class="row">
                <div class="col-12 col-sm-12 col-md-9 col-lg-8 col-xl-7">
                    <h3>Вводы</h3>
                    <div class="admin-content-block">
                        <div class="table-wrap table-wrap--block">
                            <table class="table table--text table--internal-border text-center">
                                <thead>
                                <tr class="no-hover">
                                    <th width="25%">Дата</th>
                                    <th width="25%">Сумма</th>
                                    <th width="25%">email</th>
                                    <th width="25%">Телефон</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                @foreach($invested_transactions as $transaction)
                                    <tr>
                                        <td>
                                            {{ $transaction->created_at }}
                                        </td>
                                        <td>
                                            ${{ number_format($transaction->amount_usd, 2, $dec_point = ".", $thousands_sep = " " ) }}
                                        </td>
                                        <td>
                                            {{ $transaction->email }}
                                        </td>
                                        <td>
                                            {{ $transaction->phone }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Выводы --}}
            <div class="row">
                <div class="col-12 col-sm-12 col-md-9 col-lg-8 col-xl-7">
                    <h3>Выводы</h3>
                    <div class="admin-content-block">
                        <div class="table-wrap table-wrap--block">
                            <table class="table table--text table--internal-border text-center">
                                <thead>
                                <tr class="no-hover">
                                    <th width="25%">Дата</th>
                                    <th width="25%">Сумма</th>
                                    <th width="25%">email</th>
                                    <th width="25%">Телефон</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($withdrawal_transactions as $transaction)
                                    <tr>
                                        <td>
                                            {{ $transaction->created_at }}
                                        </td>
                                        <td>
                                            ${{ number_format(-$transaction->amount_usd, 2, $dec_point = ".", $thousands_sep = " " ) }}
                                        </td>
                                        <td>
                                            {{ $transaction->email }}
                                        </td>
                                        <td>
                                            {{ $transaction->phone }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Зарегистрированные пользователи --}}
            <div class="row">
                <div class="col-12 col-sm-12 col-md-9 col-lg-8 col-xl-7">
                    <h3>Зарегистрировались</h3>
                    <div class="admin-content-block">
                        <div class="table-wrap table-wrap--block">
                            <table class="table table--text table--internal-border text-center">
                                <thead>
                                <tr class="no-hover">
                                    <th width="25%">Дата</th>
                                    <th width="25%">email</th>
                                    <th width="25%">Телефон</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($reg_users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->created_at }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('#datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            locale: 'ru-ru',
        });

        $('#datepicker2').datepicker({
            format: 'yyyy-mm-dd',
            locale: 'ru-ru',
            todayHighlight: true,
        });
    </script>
@endsection