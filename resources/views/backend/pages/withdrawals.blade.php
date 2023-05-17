@extends('layouts.app')

{{-- Секция для выполнения вывода средств --}}
@section('content')
    <div class="main_wrapper main_finance main_tabs_content">
        <div class="tabs_header">
            <button class="tabs_btn active" data-content="withdrawals">@lang('cabinet_withd.page.tab_go_withdrawals')</button>
        </div>
        <div class="tabs_content">
            <div class="content withdrawals active">
                {{-- Withdrawal form --}}
                @include('backend.includes.components.page_withdrawals.withdrawals_form')
            </div>
        </div>
    </div>
    <div class="main_wrapper main_history main_tabs_content">
        <div class="tabs_header">
            <button class="tabs_btn active" data-content="withdrawals">@lang('cabinet_withd.page.tab_withdrawals')</button>
            <button class="tabs_btn" data-content="active_withdrawals">@lang('cabinet_withd.page.tab_withdrawals_active')</button>
        </div>
        <div class="tabs_content">
            <div class="content withdrawals active">
                @include('backend.includes.components.page_transactions.base_transactions', [
                'transactions' => $view_model->withdrawals
                ])
            </div>
            <div class="content active_withdrawals">
                @include('backend.includes.components.page_transactions.withdrawals_request_transactions', [
                'transactions' => $view_model->withdrawal_requests
                ])
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection