@extends('layouts.app')

{{-- Секция контента --}}
@section('content')

<div class="main_wrapper main_profile main_tabs_content">
    <div class="tabs_header">
        <button class="tabs_btn active" data-content="profile">@lang('cabinet_profile.page.tab_profile')</button>
        <button class="tabs_btn" data-content="security">@lang('cabinet_profile.page.tab_security')</button>
        <button class="tabs_btn" data-content="my_accounts">@lang('cabinet_profile.page.tab_my_accounts')</button>
    </div>
    <div class="tabs_content">
        
        <div class="content active profile">
            <div class="zone">
                {{-- Имя, фамилия. Номер телефона --}}
                @include('backend.includes.components.page_profile.user_data')

            </div>
            <div class="zone">
                <div class="about">
                    <p>@lang('cabinet_profile.page.profile_about_1')</p>
                    <p>@lang('cabinet_profile.page.profile_about_2')</p>
                </div>
            </div>
        </div>

        {{-- Безопасность --}}
        <div class="content security">
            <div class="zone">
                {{-- Resset password --}}
                @include('backend.includes.components.page_profile.user_password')

                {{-- Resset email --}}
                @include('backend.includes.components.page_profile.user_email')
            </div>
            <div class="zone">
                <div class="about">
                    <p>@lang('cabinet_profile.page.security_about_1')</p>
                    <p>@lang('cabinet_profile.page.security_about_2')</p>
                    <p>@lang('cabinet_profile.page.security_about_3')</p>
                </div>
            </div>
        </div>

        <div class="content my_accounts">
            <div class="zone">
                {{-- Форма с реквизитами пользователя --}}
                @include('backend.includes.components.page_profile.user_accounts')
                
            </div>
            <div class="zone">
                <div class="about">
                    <p>@lang('cabinet_profile.page.my_accounts_about_1')</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
