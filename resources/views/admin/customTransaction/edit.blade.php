@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <h1 class="h2">Редактирование данных пользовательских переводов</h1>
        <form action="{{route('admin.customTransaction.update')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="commission">Комиссия, %:</label>
                    <input required type="text" value="{{$commission}}" name="commission" class="form-control" id="commission" aria-describedby="emailHelp" placeholder="5">
                    <small id="number" class="form-text text-muted">Введите число</small>
                </div>
                <div class="form-group">
                    <label for="min">Минимальная сумма перевода:</label>
                    <input required type="number" value="{{$min}}" name="min" class="form-control" id="min" aria-describedby="emailHelp" placeholder="10">
                    <small id="emailHelp" class="form-text text-muted">Введите число</small>
                </div>
                <div class="form-group">
                    <label for="max">Максимальная сумма перевода:</label>
                    <input required type="number" value="{{$max}}"  name="max" class="form-control" id="max" aria-describedby="maxHelp" placeholder="5000">
                    <small id="maxHelp" class="form-text text-muted">Введите число</small>
                </div>
                <button type="submit" class="btn btn-dark">Применить</button>
                <a href="{{route('admin.customTransaction.main')}}" class="btn text-white btn-secondary">Назад</a>
            </form>
    </div>
@endsection
