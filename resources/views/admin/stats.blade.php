{{--@extends('layouts.admin')--}}

{{--@section('content')--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-4">--}}
{{--            @include('admin.includes.partials.system.accruals_params')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('layouts.admin')

@section('content')
    <style>
        .admin-hint-block {
            color: #c9c9c9;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Статистика общая</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-condensed without-datatable">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Показатель</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($statsGlobal)
                        <tr>
                            <td>Клиенты без депозитов <span class="admin-hint-block">(кол-во)</span></td>
                            <td>{{ $statsGlobal['count_users_without_plans'] }}</td>
                        </tr>
                        <tr>
                            <td>Клиенты без реф ссылок и без депозитов <span class="admin-hint-block">(кол-во)</span></td>
                            <td>{{ $statsGlobal['count_users_without_plans_and_without_ref'] }}</td>
                        </tr>
                        <tr>
                            <td>Клиенты с реф ссылкой и без депозитов <span class="admin-hint-block">(кол-во)</span></td>
                            <td>{{ $statsGlobal['count_users_with_plans_and_without_ref'] }}</td>
                        </tr>
                        <tr>
                            <td>Активные пакеты <span class="admin-hint-block">(кол-во)</span></td>
                            <td>{{ $statsGlobal['count_plans_active'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2">Нет данных.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Статистика за период</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <form action="{{ route('admin.stats') }}" method="get">
                    <div class="input-group mb-2 mr-sm-2">
                        <input name="filter[from]" placeholder="Дата начала" required value="{{ request('filter.from') }}" type="text" id="datepicker-ref-from" class="form-control">
                    </div>

                    <div class="input-group  mb-2 mr-sm-2">
                        <input name="filter[to]" placeholder="Дата конца" required value="{{ request('filter.to') }}" type="text" id="datepicker-ref-to" class="form-control">
                    </div>

                    <button type="submit" value="get_stats" class="btn btn-success">Показать статистику</button>
                </form>
            </div>
            <div class="col-12">
                <table class="table table-condensed without-datatable">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Показатель</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($stats)
                    <tr>
                        <td>
                            Купили пакетов
                            <span class="admin-hint-block">
                                (кол-во)
                            </span>
                        </td>
                        <td>{{ $stats['count_plans_new'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>
                            Купили пакетов
                            <span class="admin-hint-block">
                                (сумма $)
                            </span>
                        </td>
                        <td>${{ $stats['sum_plans_new'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>
                            Выведено денег
                            <span class="admin-hint-block">
                                (сумма в $)
                            </span>
                        </td>
                        <td>${{ $stats['sum_withdraw'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>
                            Новых регистраций
                            <span class="admin-hint-block">(всего подтвержденных и не подтвержденных)</span>
                        </td>
                        <td>{{ $stats['count_users_new_all'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>
                            Новых регистраций
                            <span class="admin-hint-block">(с подтвержденной почтой)</span>
                        </td>
                        <td>{{ $stats['count_users_new'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>Топ пакеты
                            <span class="admin-hint-block">
                                (какой пакет покупали больше всего)
                            </span>
                        </td>
                        <td>
                            @foreach($stats['top_marketing_plan'] as $markeingPlan)
                                {{ $markeingPlan->name }} ({{ $markeingPlan->cnt  }})<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>
                            Топ инвесторов
                            <span class="admin-hint-block">
                                (кто больше всего покупает инвест пакетов)
                            </span>
                        </td>
                        <td>
                            @foreach($stats['count_users_invest_max'] as $index => $user)
                                {{ $index + 1 }}. {{ $user->email }} (${{ $user->sum }})<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>Клиенты которые выводят больше всех <span class="admin-hint-block">(топ 10)</span></td>
                        <td>
                            @foreach($stats['count_users_withdraw_max'] as $markeingPlan)
                                {{ $markeingPlan->email }} (${{ $markeingPlan->sum  }})<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>



                    <tr>
                        <td>Количество отправленных инвайтов <span class="admin-hint-block">(за период)</span></td>
                        <td>
                            Общие количество: @isset($invite) {{$invite['total']}} @else 0 @endisset<br>
                            Из них активировано: @isset($invite) {{$invite['activated']}} @else 0 @endisset<br>
                            Из них в ожидании: @isset($invite) {{$invite['pending']}} @else 0 @endisset<br>
                            Из них просрочено: @isset($invite) {{$invite['expired']}} @else 0 @endisset<br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Топ 10 отправителей инвайтов<span class="admin-hint-block">(Инвайты которые активированы, с количеством для каждого отправителя)</span></td>
                        <td>
                            @isset($topSenderInvite)
                                @foreach($topSenderInvite as $senderInvite)
                                    {{ $senderInvite['email'] }} ({{ $senderInvite['count_package']  }})<br>
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Количество открытых пакетов с помощью инвайтов</td>
                        <td>
                            @isset($countPackageInvite) {{$countPackageInvite}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Сумма открытых пакетов с помощью инвайтов</td>
                        <td>
                            @isset($sumPackageInvite) {{$sumPackageInvite}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Сумма внутренних переводов</td>
                        <td>
                            @isset($sumInternalTransfer) {{$sumInternalTransfer}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Количество открытых пакетов</td>
                        <td>
                            @isset($countOpenPackage) {{$countOpenPackage}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Количество закрытых пакетов</td>
                        <td>
                            @isset($countClosePackage) {{$countClosePackage}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Список пакетов в порядке убывания прибыльности <span class="admin-hint-block">(количества выведенных на баланс средств)</span></td>
                        <td>
                            @isset($listPackages) {{$listPackages}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Сумма пополнений</td>
                        <td>
                            @isset($replenishmentAmount) ${{number_format( $replenishmentAmount, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Выплачено бонусов по линейной программе</td>
                        <td>
                            @isset($bonusLineProgram) ${{number_format( $bonusLineProgram, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Выплачено бонусов по карьерной программе</td>
                        <td>
                            @isset($bonusCareerProgram) ${{number_format( $bonusCareerProgram, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Выплачено матчинг-бонусов</td>
                        <td>
                            @isset($matchingBonus) ${{number_format( $matchingBonus, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Топ-10 пользователей <span class="admin-hint-block">(по сумме внутренних переводов)</span></td>
                        <td>
                            @isset($sumInternalTransferTop)
                                @foreach($sumInternalTransferTop as $internalTransfer)
                                    {{ $internalTransfer['email'] }} (${{ $internalTransfer['withdrawal_amount']*(-1) }})<br>
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Рейтинг городов <span class="admin-hint-block">(по количеству зарегистрированных пользователей)</span></td>
                        <td>
                            @isset($cities)
                                @foreach($cities as $city)
                                    {{ $city['city'] }} {{ $city['count_city'] }}<br>
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Всего комиссии по инвайтам <span class="admin-hint-block">(Сколько было заработано на комиссии с инвайтов)</span></td>
                        <td>
                            @isset($totalCommissionInvite) ${{number_format( $totalCommissionInvite, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Комиссии по инвайтам <span class="admin-hint-block">(Топ 10 пользователей)</span></td>
                        <td>
                            @isset($topUserCommissionInvite)
                                @foreach($topUserCommissionInvite as $commissionInvite)
                                    {{ $commissionInvite['email'] }} ${{ number_format( $commissionInvite['profit'], 2 ) }}<br>
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Всего комиссии по выводам </td>
                        <td>
                            @isset($totalCommissionConclusions) ${{number_format( $totalCommissionConclusions, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Комиссии по выводам <span class="admin-hint-block">(Топ 10 пользователей)</span></td>
                        <td>
                            @isset($topCommissionConclusions)
                                @foreach($topCommissionConclusions as $commissionConclusions)
                                    {{ $commissionConclusions['email'] }} ${{ number_format( $commissionConclusions['transactions_commission'], 2 ) }}<br>
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Всего комиссии по внутренним переводам </td>
                        <td>
                            @isset($totalCommissionInternalTransfer) ${{number_format( $totalCommissionInternalTransfer, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Комиссии по внутренним переводам <span class="admin-hint-block">(Топ 10 пользователей)</span></td>
                        <td>
                            @isset($topCommissionInternalTransfer)
                                @foreach($topCommissionInternalTransfer as $commissionInternalTransfer)
                                    {{ $commissionInternalTransfer['email'] }} ${{ number_format( $commissionInternalTransfer['profit'], 2 ) }}<br>
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Долг по пакетам <span class="admin-hint-block">(Которые не рэндомные, без крипты)</span></td>
                        <td>
                            @isset($debtDeposit) ${{number_format( $debtDeposit, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>

                    <tr>
                        <td>Долг по пакетам плавающий <span class="admin-hint-block">(Рэндомный процент, без крипты)</span></td>
                        <td>
                            @isset($debtDepositFloating) ${{number_format( $debtDepositFloating, 2)}} @else 0 @endisset
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>




                    @else
                        <tr>
                            <td colspan="2">Нет данных.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ru.min.js" integrity="sha512-tPXUMumrKam4J6sFLWF/06wvl+Qyn27gMfmynldU730ZwqYkhT2dFUmttn2PuVoVRgzvzDicZ/KgOhWD+KAYQQ==" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('#datepicker-ref-from').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                language: 'ru'
            });

            $('#datepicker-ref-to').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                language: 'ru'
            });
        });
    </script>
@endsection
