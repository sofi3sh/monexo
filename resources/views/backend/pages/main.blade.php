@extends('layouts.app')

@section('content')
    {{-- Статистика по балансу --}}
    @include('backend.includes.components.page_main.money_statistic')

    {{-- Слайдеро планов, статистика по планам, блок с реф. ссылкой --}}
    <div class="base_column_wrapper">
        <div class="base_wrapper main_plan_and_statistic">
            {{-- Блок с маркетинг планами --}}
            @include('backend.includes.components.page_main.plan_slider')

            {{-- Статистика по маркетинговым планам --}}
            @include('backend.includes.components.page_main.plan_statistic')
        </div>
        <div class="base_wrapper main_reflink" style="margin: 0px 0px 0px 10px;">
            {{-- Блок с реферальной ссылкой --}}
            @include('backend.includes.components.page_main.referral_link')
        </div>
    </div>
@endsection

@section('scripts')
    @if($isFirstVisit)
        <script>
            $(".base_modal.help_window").addClass("active");
        </script>
    @endif
@endsection