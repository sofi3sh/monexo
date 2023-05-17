@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <p><strong>Комиссия:</strong> {{$commission}}%</p>
            <p><strong>Минимальная сумма перевода:</strong> ${{$min}}</p>
            <p><strong>Максимальная сумма перевода:</strong> ${{$max}}</p>
        </div>
        <a href="{{route('admin.customTransaction.edit')}}" class="btn btn-dark">Изменить</a>
    </div>

@endsection
