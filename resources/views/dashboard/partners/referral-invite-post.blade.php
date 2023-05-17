@extends('auth.layout')

@section('content-up')
    <div class="container text-white">
        <h1 class="h1 text-center text-white">
            @if($errors)
                Ошибка!
            @else
                Приглашение успешно отправлено!
            @endif
        </h1>

        @if($errors)

            @foreach($errors as $error)
                <p>{{$error}}</p>
            @endforeach

        @else
            @isset($referralEmail)
                <p><strong>Email:</strong> {{$referralEmail}}</p>
            @endisset
            @if($depositAmount > 0)
                <p><strong>Пакет:</strong> {{$package}}</p>
                <p><strong>Сумма депозита:</strong> ${{$depositAmount}}</p>
            @endif
        @endif

        <a href="{{route('home.main')}}" class="btn btn-white text-primary" type="button">В личный кабинет</a>
    </div>
@endsection
