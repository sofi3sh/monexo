@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-center">Редактирование настроек новостной рассылки</h1>
        <form action="{{route('admin.news-subscribes.update')}}" method="POST">
            @csrf
            
            @php
                $days = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
            @endphp

            <h2 class="h6">
                <b>Еженедельная подписка:</b> 
            </h2>
            <label for="week_day">День недели:</label>
            <select id="week_day" class="form-control mb-3" value="{{$settings->week_day}}" name="week_day" required>
                @foreach ($days as $index => $day)
                    <option value="{{$index}}" @if($index == $settings->week_day) selected @endif>{{$day}}</option>
                @endforeach
            </select>
            <label for="week_time">Время (мск):</label>
            <input id="week_time" class="form-control" value="{{$settings->week_dispatch_time}}" name="week_dispatch_time" required/>
            <h2 class="h6">
                <b>Ежемесячная подписка:</b> 
            </h2>
            <label for="month_day">День месяца:</label>
            <input id="month_day" class="form-control" value="{{$settings->month_day}}" name="month_day" required/>
            
            <label for="month_time">Время (мск):</label>
            <input id="month_time" class="form-control mb-3" value="{{$settings->month_dispatch_time}}" name="month_dispatch_time" required/>

            <button type="submit" class="btn btn-dark">Сохранить</button>
            <a href="{{route('admin.news-subscribes.index')}}" type="button" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
    
@endsection