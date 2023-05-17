@extends('layouts.app')

{{-- Секция формы изменения профиля --}}
@section('content')
    <div class="container-fluid">
        <div class="page-setings">
            <div class="profile-wrapper">
                {{-- Сообщения --}}
                @include('includes.partials.messages')

                <div class="profile-title">
                    <h1>{{ __('strings.backend.profile.profile') }}</h1>
                </div>
                <form action="{{ route('home.profile.patch-avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('patch') }}
                    <div class="settings-profile">

                        {{-- Аватарка --}}
                        {{--------------}}
                        <div class="profile-block--avatar">
                            <div class="profile--user-avatar-block">
                                @if(!is_null(Auth::user()->getMedia('avatars')->last()))
                                    <img src="{{ Auth::user()->getMedia('avatars')->last()->getUrl('thumb') }}">
                                @endif
                            </div>
                            <div class="pb--avatar-info">
                                <div class="avatar-info--control">
                                    <label for="avatar" class="col-form-label profile--user-avatar">
                                        {{ __('strings.backend.profile.main.avatar.upload') }}
                                    </label>
                                    <input id="avatar" type="file" class="input input--middle settings-profile__input" name="avatar" accept=".jpg, .jpeg, .png" hidden>
                
                                    {{-- Кнопка Save --}}
                                    <button type="submit" class="button button--middle profile--user-avatar-save">{{ __('strings.backend.profile.update') }}</button>
                                </div>
                                <div class="avatar-info--rules">
                                    <small>{{ __('strings.backend.profile.main.avatar.rule1') }}</small>
                                    <small>{{ __('strings.backend.profile.main.avatar.rule2') }}</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

                {{-- Имя, фамилия. Номер телефона. --}}
                {{-----------------------------------}}
                <form action="{{ route('home.profile.patch-name-phone') }}" method="POST">
                    @csrf
                    {{ method_field('patch') }}
                    <div class="settings-profile">

                        <div class="profile-block--wrapper">
                            {{-- Фамилия, имя --}}
                            <div class="profile-block--input">
                                <label for="name" class="input-title">
                                    <h3>{{ __('strings.backend.profile.main.data.fullname') }}</h3>
                                </label>
                                <input type="text" name="name" 
                                       class="input input--middle settings-profile__input" 
                                       value="{{ old('name', $user->name ?? '') }}" 
                                       placeholder="{{ __('strings.backend.profile.name') }}">
                            </div>

                            {{-- Телефон --}}
                            <div class="profile-block--input">
                                <label for="phone" class="input-title">
                                    <h3>{{ __('strings.backend.profile.main.data.phone') }}</h3>
                                </label>
                                <input type="text" name="phone"
                                       class="input input--middle settings-profile__input {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       {{-- todo Выражение сделать хелпером --}} 
                                       value="{{ old('phone', $user->phone ?? '') }}" 
                                       placeholder="{{ __('strings.backend.profile.main.data.phone-plc') }}">
                            </div>

                            {{-- email --}}
                            <div class="profile-block--input">
                                <label for="email" class="input-title">
                                    <h3>{{ __('strings.backend.profile.main.data.email') }}</h3>
                                </label>
                                <input type="text" name="email" 
                                       class="input input--middle settings-profile__input" readonly
                                       value={{ $user->email }}>
                            </div>

                        </div>
                    </div>

                    {{-- Кнопка --}}
                    <div class="input-row settings-profile-confirm" style="padding-top: 2em">
                        <button type="submit" class="button button--middle">{{ __('strings.backend.profile.update') }}</button>
                    </div>
                </form>

                {{-- Resset password --}}
                <div class="profile-title">
                    <h2>{{ __('strings.backend.profile.main.password.reset-title') }}</h2>
                </div>
                <form action="{{ route('home.profile.password.path') }}" method="POST">
                    @csrf
                    {{ method_field('patch') }}
                    <div class="settings-profile">
                        <div class="profile-resset-password profile-block--wrapper">
                        {{--<input type="password" name="current" class="input input--middle settings-profile__input"
                               placeholder="Текущий пароль">--}}
                            <div class="profile-block--input">
                                <label for="password" class="input-title">
                                    <h3>{{ __('strings.backend.profile.new_password1') }}</h3>
                                </label>
                                <input type="password" name="password" class="input input--middle settings-profile__input"
                                       placeholder="**********">
                            </div>
                            <div class="profile-block--input">
                                <label for="password_confirmation" class="input-title">
                                    <h3>{{ __('strings.backend.profile.new_password2') }}</h3>
                                </label>
                                <input type="password" name="password_confirmation" class="input input--middle settings-profile__input"
                                       placeholder="**********">
                            </div>
                        </div>
                        <div class="settings-profile-confirm">
                            <button class="button settings-profile--submit-button" type="submit">{{ __('strings.backend.profile.change-pwd') }}</button>
                        </div>
                    </div>
                </form>

                {{-- todo-y Красота, локализация --}}
                {{-- Resset email --}}
                <div class="profile-title">
                    <h2>Хотите изменить email?</h2>
                </div>
                <form action="{{ route('home.profile.send-email') }}" method="POST">
                    @csrf
                    <div class="settings-profile">
                        <div class="profile-resset-password profile-block--wrapper">
                            <div class="profile-block--input">
                                <label for="email" class="input-title">
                                    <h3>Введите новый email</h3>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" class="input input--middle settings-profile__input">
                            </div>
                            <div class="profile-block--input">
                                <label for="email_confirmation" class="input-title">
                                    <h3>Повторите email</h3>
                                </label>
                                <input type="email" name="email_confirmation" value="{{ old('email_confirmation') }}" class="input input--middle settings-profile__input">
                            </div>
                        </div>
                        <div class="settings-profile-confirm">
                            <button class="button settings-profile--submit-button" type="submit">Отправить письмо</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="profile-nav">
                {{-- Меню для страницы настроек --}}
                @include('backend.includes.partials.options-menu')
            </div>
        </div>
    </div>
@endsection
