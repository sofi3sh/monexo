@extends('auth.layout')
{{-- Секция ввода email для отправки ссылки для сброса пароля. --}}
@section('content')

{{-- Main --}}
<main class="main" id="main">
    {{-- Present --}}
    <div class="main_auth">
        <div class="base_wrapper content">
            <div class="logo">
                <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="graybet">
            </div>
            <div class="title">
                <h2>@lang('website_auth.reset_password.title')</h2>
                <small>@lang('website_auth.reset_password.sub_title')</small>
            </div>
            <form action="{{ route('password.email') }}" method="POST" class="auth_form form">
                @csrf

                <div class="block">
                    <label for="email">@lang('website_auth.reset_password.email')</label>
                    <input type="email" name="email" id="email" min="5" required value="{{ old('email') }}">
                </div>
                @include('includes.partials.messages')
                <div class="block">
                    <button type="submit">@lang('website_auth.reset_password.button')</button>
                </div>
            </form>
            <div class="small_link sign_up">
                <h5>@lang('website_auth.reset_password.return_login')</h5>
                <a href="{{ route('login') }}">@lang('website_auth.reset_password.sign_in_go_lnik')</a>
            </div>
        </div>
    </div>
</main>

@endsection
