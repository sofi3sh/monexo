@extends('layouts.app')

@section('content')
    <div class="base_column_wrapper plans_rows">
        <div class="base_wrapper main_plan_and_statistic">
            {{-- Блок с маркетинг планами --}}
            @include('backend.includes.components.page_main.plan_slider')

            {{-- Покупка маркетингового плана --}}
            @include('backend.includes.components.page_plans.plans_buy_form')

            {{-- Статистика по маркетинговым планам --}}
            @include('backend.includes.components.page_main.plan_statistic')
        </div>

        {{-- Блоки с детальной информацией о планах --}}
        <div class="base_wrapper main_plan_detailed">
            @include('backend.includes.components.page_plans.plans_detailed')
        </div>

        {{-- Калькулятор для расчета ~ прибыли с инвестиции --}}
        <div class="base_wrapper main_calculator">
            @include('backend.includes.components.page_plans.plan_calc')
        </div>

        <div class="base_wrapper main_plan_about">
            <div class="main_wrapper main_ref_text">
                <h2 class="title">@lang('cabinet_plans.page.about_marketing_title')</h2>
                <div class="about_text">
                    @lang('cabinet_plans.page.about_info_and_link')
                </div>
            </div>
            <div class="main_wrapper main_plans_history main_tabs_content">
                <div class="tabs_header">
                    <button class="tabs_btn active" data-content="plans_history">@lang('cabinet_plans.page.header_history')</button>
                </div>
                <div class="tabs_content">
                        <div class="content plans_history active">
                            @include('backend.includes.components.page_plans.plans_transactions', [
                            'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::MARKET_PLANS_INVEST)[1]
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal window's --}}
    @include('backend.includes.components.page_plans.modal_invest')
    @include('backend.includes.components.page_plans.modal_prospects')
    @include('backend.includes.components.page_plans.modal_prosp_invest')
@endsection
