@extends('layouts.app')

@section('content')
<div class="main_wrapper main_transaction main_tabs_content">
    <div class="tabs_header">
        <button class="tabs_btn active" data-content="invest">@lang('cabinet_trans.page.tab_invest')</button>
        <button class="tabs_btn" data-content="plans_history">@lang('cabinet_plans.page.header_history')</button>
        <button class="tabs_btn" data-content="plans_income">@lang('cabinet_trans.page.tab_income')</button>
        <button class="tabs_btn" data-content="plans_ref_income">@lang('cabinet_trans.page.tab_ref_income')</button>
        <button class="tabs_btn" data-content="withdrawals">@lang('cabinet_trans.page.tab_withdrawals')</button>
        <button class="tabs_btn" data-content="active_withdrawals">@lang('cabinet_trans.page.tab_active_withdrawals')</button>
    </div>
    <div class="tabs_content">
        <div class="content invest active">
            @include('backend.includes.components.page_transactions.base_transactions', [
            'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::ALL_INVEST_TYPES)[1]
            ])
        </div>
        <div class="content plans_history">
            @include('backend.includes.components.page_plans.plans_transactions', [
            'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::MARKET_PLANS_INVEST)[1]
            ])
        </div>
        <div class="content plans_income">
            @include('backend.includes.components.page_transactions.base_transactions', [
            'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::ALL_PROFIT_NOT_REF_TYPES)[1]
            ])
        </div>
        <div class="content plans_ref_income">
            @include('backend.includes.components.page_transactions.base_transactions', [
            'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::ALL_REFERRAL_PROFIT_TYPES)[1]
            ])
        </div>
        <div class="content withdrawals">
            @include('backend.includes.components.page_transactions.base_transactions', [
            'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)[1]
            ])
        </div>
        <div class="content active_withdrawals">
            @include('backend.includes.components.page_transactions.withdrawals_request_transactions', [
            'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID)[1]
            ])
        </div>
    </div>
</div>
@endsection