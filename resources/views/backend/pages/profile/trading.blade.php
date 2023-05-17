@extends('layouts.app')

{{-- Секция формы изменения профиля --}}
@section('content')
    <div class="container-fluid">
        <div class="page-setings">
            {{-- Меню для страницы настроек --}}
            @include('backend.includes.partials.options-menu')
            {{-- Форма создания заявки --}}
            <form action="{{ route('home.profile.trading.path') }}" method="POST">
                @csrf
                {{ method_field('patch') }}
                <div class="settings-profile">
                    <div class="settings-head">Биржа</div>
                    {{-- Биржа --}}
                    <input type="text" name="exchange_name" class="input input--middle settings-profile__input"
                           value="{{ old('name', $user->name ?? '') }}" placeholder='Биржа'>
                    <div class="settings-head">API-ключ</div>
                    {{-- API-ключ --}}
                    <input type="text" name="api-key"
                           class="input input--middle settings-profile__input">
                    {{--@error('phone')
                        <span>{{ $message }}</span>
                    @enderror--}}
                </div>
                {{-- Кнопка --}}
                <div class="input-row" style="padding-top: 2em">
                    {{-- Сообщения --}}
                    @include('includes.partials.messages')
                    <button type="submit" class="button button--middle">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
