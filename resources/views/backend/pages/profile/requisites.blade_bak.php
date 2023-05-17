@extends('layouts.app')

{{-- Страница для requisites --}}
@section('content')
    <div class="container-fluid">
        <div class="page-requisites">
            {{-- Меню для страницы настроек --}}
            @include('backend.includes.partials.options-menu')
            
            {{-- Сообщения --}}
            @include('includes.partials.messages')

            {{-- Форма создания заявки --}}
            <form action="{{ route('home.profile.profile.patch') }}" method="POST">
                @csrf
                {{ method_field('patch') }}

                <div class="settings-head">
                    <h1>{{ __('strings.backend.profile.requisites') }}</h1>
                </div>
                <div class="settings-profile">
                    {{-- Visa --}}
                    <h3>{{ __('strings.backend.profile.visa-title') }}</h3>
                    <input type="text" name="visa" class="input input--middle settings-profile__input"
                           value="{{ old('visa', $user->visa ?? '') }}"
                           placeholder="{{ __('strings.backend.profile.visa') }}">
                           
                    {{-- MasterCard --}}
                    <h3>{{ __('strings.backend.profile.mastercard-title') }}</h3>
                    <input type="text" name="mastercard" class="input input--middle settings-profile__input"
                            value="{{ old('mastercard', $user->mastercard ?? '') }}"
                            placeholder="{{ __('strings.backend.profile.mastercard') }}">
                    
                    {{-- QIWI --}}
                    <h3>{{ __('strings.backend.profile.qiwi-title') }}</h3>
                    <input type="text" name="qiwi" class="input input--middle settings-profile__input"
                            value="{{ old('qiwi', $user->qiwi ?? '') }}"
                            placeholder="{{ __('strings.backend.profile.qiwi') }}">
                           
                    {{-- WebMoney --}}
                    <h3>{{ __('strings.backend.profile.webmoney-title') }}</h3>
                    <input type="text" name="webmoney" class="input input--middle settings-profile__input"
                            value="{{ old('webmoney', $user->webmoney ?? '') }}"
                            placeholder="{{ __('strings.backend.profile.webmoney') }}">
                           
                    {{-- Yandex.money --}}
                    <h3>{{ __('strings.backend.profile.yandexMoney-title') }}</h3>
                    <input type="text" name="yandexMoney" class="input input--middle settings-profile__input"
                            value="{{ old('yandexMoney', $user->yandexMoney ?? '') }}"
                            placeholder="{{ __('strings.backend.profile.yandexMoney') }}">
                            
                    {{-- Кнопка --}}
                    <div class="input-row" style="padding-top: 2em">
                        <button type="submit" class="button button--middle">
                            {{ __('strings.backend.profile.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
