@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-setings">
            {{-- Меню для страницы настроек --}}
            @include('backend.includes.partials.options-menu')
            {{-- Сообщения --}}
            @include('includes.partials.messages')
            <div class="settings-head">Смена пароля</div>
            <form action="{{ route('home.profile.password.path') }}" method="POST">
                @csrf
                {{ method_field('patch') }}
                <div class="settings-profile">
                    {{--<input type="password" name="current" class="input input--middle settings-profile__input"
                           placeholder="Текущий пароль">--}}
                    <input type="password" name="password" class="input input--middle settings-profile__input"
                           placeholder="Введите новый пароль">
                    <input type="password" name="password_confirmation" class="input input--middle settings-profile__input"
                           placeholder="Подтвердите пароль">
                    <button class="button settings-profile--submit-button" type="submit">Изменить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
