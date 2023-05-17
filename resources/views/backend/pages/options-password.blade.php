@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-setings">
            {{-- Меню для страницы настроек --}}
            @include('backend.includes.partials.options-menu')

            <div class="settings-head">{{ __('strings.backend.profile.change-password') }}</div>
            <form action="#">
                <div class="settings-profile">
                    <input type="password" class="input input--middle settings-profile__input"
                           placeholder="{{ __('strings.backend.profile.new_password1') }}">
                    <input type="password" class="input input--middle settings-profile__input"
                           placeholder="{{ __('strings.backend.profile.new_password2') }}">
                    <button class="button settings-profile--submit-button" type="submit">{{ __('strings.backend.profile.change-pwd') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection
