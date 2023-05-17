@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <b style="color: #c51f1a">@if($diff_in_minutes>30) Последнее обновление курсов: {{ $rates_last_update }} @endif</b>
                <h2>Последние события за 48 часов:</h2>(бзе событий по фейковым юзерам)
                <div class="admin-content-block">
                    <h4>Введено:</h4>
                    @include('admin.includes.partials.main.transactions', ['transactions' => $invested])
                </div>
                <div class="admin-content-block">
                    <h4>Бонусы:</h4>
                    @include('admin.includes.partials.main.bonuses', ['bonuses' => $bonuses])
                </div>
                <div class="admin-content-block">
                    <h4>Созданные заявки на вывод:</h4>
                    @include('admin.includes.partials.main.transactions', ['transactions' => $withdrawal_requests])
                </div>
                <div class="admin-content-block">
                    <h4>Выведено:</h4>
                    @include('admin.includes.partials.main.transactions', ['transactions' => $withdrawals])
                </div>
                <div class="admin-content-block">
                    <h4>Начислено через админ:</h4>
                    @include('admin.includes.partials.main.accrued-through-admin', ['transactions' => $replenish_from_admin])
                </div>
                <div class="admin-content-block">
                    <h4>Начислено:</h4>
                    @include('admin.includes.partials.main.accruals')
                </div>
                <div class="admin-content-block">
                    <h4>Переводы между аккаунтами:</h4>
                    @include('admin.includes.partials.main.transfers-between-accounts')
                </div>
            </div>
        </div>
    </div>
@endsection