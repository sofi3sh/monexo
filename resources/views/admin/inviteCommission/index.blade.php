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
        <h1 class="h3 text-center">Комиссия за инвайт</h1>
        <h2 class="h6">Комиссия при отправке пригласительного депозита в процентах (Может быть установлена от 0 до 100%):</h2>
        <ul>
            <li>Комиссия:   {{$commission ?? 'Не установлено' . '%' }}</li>
        </ul>
        <a class="btn btn-dark" href="{{route('admin.invite-commission.edit')}}">Изменить</a>
    </div>
@endsection
