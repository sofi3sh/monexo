@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-3">
        <h1 class="h2 text-center">Рассылка новостей</h1>
        <p class="mb-1"><b>Текущие настройки:</b></p>
        <div class="mb-3">
            Еженедельная рассылка:
            <ul>
                <li>День недели: {{$settings->getDayOfWeek()}}</li>
                <li>Время (мск): {{$settings->week_dispatch_time}}</li>
            </ul>
            Ежемесячная рассылка:
            <ul>
                <li>Дата(число): {{$settings->month_day}}</li>
                <li>Время (мск): {{$settings->month_dispatch_time}}</li>
            </ul>
        </div>
        <div class="mb-3 d-flex justify-content-between flex-wrap">
            <a href="{{route('admin.news-subscribes.edit')}}" class="btn btn-dark">Изменить</a>
            <a href="{{route('admin.news-subscribes.emails-csv')}}" class="btn btn-primary">Выгрузить в CSV</a>
        </div>
        <h2 class="h5 mb-3"><b>Информация о пользователях</b></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Почта</th>
                    <th>Период подписки</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscribes as $subscribe)
                    <tr>
                        <td>{{$subscribe->user->name ?? '-'}}</td>
                        <td>{{$subscribe->user->surname ?? '-'}}</td>
                        <td>{{$subscribe->email}}</td>
                        <td>{{$subscribe->period}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
@endsection