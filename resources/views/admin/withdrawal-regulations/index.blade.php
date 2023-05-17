@extends('layouts.admin')


@section('content')
    <div class="alert">
        @if($errors->any())
            @foreach ($errors as $error)
                {{$error}}
            @endforeach
        @endif
    </div>
    <div class="container-fluid">
        <h1 class="h3 text-center">Регламент вывода средств</h1>

        <div class="mb-3">
            <h2 class="h6">Комиссии вывода средств:</h2>
            <ul>
                <li>Чаще 1 раза в 7 дней:  {{$commission['7']  . '%' }}</li>
                <li>Чаще 1 раза в 14 дней: {{$commission['14'] . '%' }}</li>
                <li>Чаще 1 раза в 30 дней: {{$commission['30'] . '%' }}</li>
                <li>Реже 1 раза в 30 дней: {{$commission['0']  . '%' }}</li>
            </ul>
            <a class="btn btn-dark" href="{{route('admin.withdrawal-regulations.commissions.edit')}}">Изменить</a>
        </div>
        
        <div>
            <h2 class="h6">
                Ограничения вывода:
            </h2>
            <ul>
                @foreach ($withdrawalLimits as $limit)
                    <li>{{$limit->name . ': $' . $limit->value }} </li>
                @endforeach
            </ul>
            <a class="btn btn-dark" href="{{route('admin.withdrawal-regulations.limits.edit')}}">Изменить</a>
        </div>
        
    </div>
@endsection