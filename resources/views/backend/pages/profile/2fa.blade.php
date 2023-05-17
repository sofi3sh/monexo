@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-setings grey-border-gg">
            <div class="profile-wrapper">
                <div class="profile-title">
                    <h1>Google 2FA ({{ __('strings.backend.profile.2fa-caption') }})</h1>
                </div>
                <div class="profile-google2fa">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(is_null($data['user']->passwordSecurity))
                        <strong>
                            {{ __('strings.backend.profile.2fa-p0') }}
                        </strong>
                        <br/>

                        <form class="form-horizontal" method="POST"
                              action="{{ route('home.profile.generate2faSecret') }}">
                            {{ csrf_field() }}
                            <div class="form-group" style="padding-top: 2em">
                                <div class="col-lg-12">
                                    <button type="submit" class="button">
                                        {{ __('strings.backend.profile.2fa-p01') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @elseif(!$data['user']->passwordSecurity->google2fa_enable)
                        <div class="profile-google2fa-stage">
                            <div class="pgs--title">
                                <h3>{{ __('strings.backend.profile.2fa-p1') }}:</h3>
                            </div>
                            <div class="pgs--content">
                                <div class="pgs--code">
                                    <img src="{{$data['google2fa_url'] }}" alt="">
                                </div>
                                <div class="pgs--code-info">
                                    <p>@lang('strings.backend.profile.2fa-about')</p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-google2fa-stage">
                            <div class="pgs--title">
                                <h3>{{ __('strings.backend.profile.2fa-p2') }}:</h3>
                            </div>
                            <div class="pgs--content">
                                <form class="form-horizontal" method="POST" action="{{ route('home.profile.enable2fa') }}">
                                    @csrf
                                    <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                        {{-- input ввода кода 2FA --}}
                                        <div class="profile-block--input profile-block--input-2fa">
                                            <input id="verify-code" type="password" class="form-control"
                                                   name="verify-code" required>
                                        </div>
                                        @if ($errors->has('verify-code'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('verify-code') }}</strong>
                                        </span>
                                        @endif

                                        {{-- Кнопка --}}
                                        <div class="input-row settings-profile-confirm" style="padding-top: 2em">
                                            <button type="submit" class="button">
                                                {{ __('strings.backend.profile.2fa-on') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @elseif($data['user']->passwordSecurity->google2fa_enable)
                        <div class="profile-google2fa-stage">
                            <div class="pgs--title">
                                <h3>@lang('strings.backend.profile.2fa-work1')</h3>
                            </div>
                            <div class="pgs--content">
                                <div class="pgs--code">
                                    <img src="{{ asset('/backend/img/profile/g2fa-com.png') }}" alt="">
                                </div>
                                <div class="pgs--code-info">
                                    <p>@lang('strings.backend.profile.2fa-about')</p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-google2fa-stage">
                            <div class="pgs--title">
                                <h3>{{ __('strings.backend.profile.2fa-work2') }}</h3>
                            </div>
                            <div class="pgs--content">
                                <form class="form-horizontal" method="POST" action="{{ route('home.profile.disable2fa') }}">
                                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                        @csrf
                                        <div class="profile-block--input profile-block--input-2fa">
                                            <label for="change-password" class="input-title">
                                                <h3>{{ __('strings.backend.profile.2fa-confirm') }}</h3>
                                            </label>
                                            <input id="current-password" type="password" class="input input--middle settings-profile__input" name="current-password" placeholder="********" required>
                                            @if ($errors->has('current-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="row settings-profile-confirm" style="padding-top: 2em">
                                            <div class="col-12">
                                                <button type="submit" class="button">
                                                    {{ __('strings.backend.profile.2fa-off') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="profile-nav">
                {{-- Меню для страницы настроек --}}
                @include('backend.includes.partials.options-menu')
            </div>
        </div>
    </div>
@endsection
