@extends('layouts.app')

{{-- Страница для requisites --}}
@section('content')
    <div class="container-fluid">
        <div class="page-requisites grey-border-gg">
            <div class="profile-wrapper">
            	{{-- Сообщения --}}
            	@include('includes.partials.messages')

	            <div class="profile-title">
	                <h1>{{ __('strings.backend.profile.nav.requisites') }}</h1>
	            </div>
            	{{-- Форма с реквизитами пользователя --}}
	            <form action="{{ route('home.profile.requisites-post') }}" method="POST">
	                @csrf
	                {{ method_field('POST') }}

	                <div class="settings-head">
	                    {{-- todo Этого нет в ресурсе строк- -}}
	                    {{--<h1>{{ __('strings.backend.profile.nav.requisites') }}</h1>--}}
	                </div>
	                <div class="settings-profile">

	                	<div class="profile-block--wrapper">
	                    	{{-- Visa --}}
		                    <div class="profile-block--input profile-block--input-req">
		                    	<label for="" class="input-req">
		                    		<img src="{{ asset('backend/img/profile/profile-visa.png') }}" alt="" style="width: 100px;">
		                    	</label>
		                        <input type="text" name="visa" class="input input--middle settings-profile__input"
		                            value="{{ old('visa', $user->visa ?? '') }}"
		                            placeholder="{{ __('strings.backend.profile.requisites.visa') }}">
		                    </div>
		                    
		                    {{-- MasterCard --}}
		                    <div class="profile-block--input profile-block--input-req">
		                    	<label for="" class="input-req">
		                    		<img src="{{ asset('backend/img/profile/profile-mastercard.png') }}" alt="" style="width: 100px;">
		                    	</label>
		                        <input type="text" name="mastercard" class="input input--middle settings-profile__input"
		                                value="{{ old('mastercard', $user->mastercard ?? '') }}"
		                                placeholder="{{ __('strings.backend.profile.requisites.mastercard') }}">
		                    </div>

		                    {{-- QIWI --}}
		                    <div class="profile-block--input profile-block--input-req">
		                    	<label for="" class="input-req">
		                    		<img src="{{ asset('backend/img/profile/profile-qiwi.png') }}" alt="" style="width: 100px;">
		                    	</label>
		                        <input type="text" name="qiwi" class="input input--middle settings-profile__input"
		                                value="{{ old('qiwi', $user->qiwi ?? '') }}"
		                                placeholder="{{ __('strings.backend.profile.requisites.qiwi') }}">
		                    </div>

		                    {{-- WebMoney --}}
		                    <div class="profile-block--input profile-block--input-req">
		                    	<label for="" class="input-req">
		                    		<img src="{{ asset('backend/img/profile/profile-webmoney.png') }}" alt="" style="width: 100px;">
		                    	</label>
		                        <input type="text" name="webmoney" class="input input--middle settings-profile__input"
		                                value="{{ old('webmoney', $user->webmoney ?? '') }}"
		                                placeholder="{{ __('strings.backend.profile.requisites.webmoney') }}">
		                    </div>

		                    {{-- Yandex.money --}}
		                    <div class="profile-block--input profile-block--input-req">
		                    	<label for="" class="input-req">
		                    		<img src="{{ asset('backend/img/profile/profile-yandexmoney.jpg') }}" alt="" style="width: 100px;">
		                    	</label>
		                        <input type="text" name="yandexMoney" class="input input--middle settings-profile__input"
		                                value="{{ old('yandexMoney', $user->yandexMoney ?? '') }}"
		                                placeholder="{{ __('strings.backend.profile.requisites.yandexMoney') }}">
		                    </div>
	                	</div>
	                    
	                    {{-- Кнопка --}}
	                    <div class="input-row settings-profile-confirm" style="padding-top: 2em">
	                        <button type="submit" class="button button--middle">
	                            {{ __('strings.backend.profile.update') }}
	                        </button>
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
