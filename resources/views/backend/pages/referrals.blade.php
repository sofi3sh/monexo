@extends('layouts.app')

@section('content')
    {{-- Статитстика и текст о партнерской программе --}}
    <div class="base_column_wrapper main_statistic_and_text">
        {{-- Реферальная статистика --}}
        @include('backend.includes.components.page_referrals.referrals_statistic')
            
        {{-- Реферальная статистика --}}
        @include('backend.includes.components.page_referrals.referrals_about')

    </div>
    {{-- Реферальная ссылки и таблицы с рефералами --}}
    <div class="base_column_wrapper main_reflink_and_referrals">
        {{-- Реферальная ссылка --}}
        @include('backend.includes.components.page_main.referral_link')

        {{-- Таблицы с рефералами --}}
        <div class="main_wrapper main_referrals main_referrals_tabs main_tabs_content">
            @include('backend.includes.components.page_referrals.transactions_referrals')
        </div>
    </div>
@endsection
