@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <h1 class="h4 text-center">Настройка комиссий для вывода, %</h1>

        <form action="{{route('admin.withdrawal-regulations.commissions.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Чаще 1 раза в 7 дней:</label>
                <input name="period-7" step="0.1" class="form-control" type="number" value="{{$commission['7']}}">
            </div>
            <div class="form-group">
                <label>Чаще 1 раза в 14 дней:</label>
                <input name="period-14" step="0.1" class="form-control" type="number" value="{{$commission['14']}}">
            </div>
            <div class="form-group">
                <label>Чаще 1 раза в 30 дней:</label>
                <input name="period-30" step="0.1" class="form-control" type="number" value="{{$commission['30']}}">
            </div>
            <div class="form-group">
                <label>Реже 1 раза в 30 дней:</label>
                <input name="period-0" step="0.1" class="form-control" type="number" value="{{$commission['0']}}">
            </div>
            <button type="submit" class="btn btn-dark">Сохранить</button>
            <a href="{{route('admin.withdrawal-regulations.index')}}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
