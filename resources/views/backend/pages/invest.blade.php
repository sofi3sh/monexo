@extends('layouts.app')

{{-- Секция для выполнения инвестиции --}}
@section('content')
    <div class="main_wrapper main_finance main_tabs_content">
        <div class="tabs_header">
            <button class="tabs_btn active" data-content="invest">@lang('cabinet_invest.invest_block.header')</button>
        </div>
        <div class="tabs_content">
            <div class="content invest active">
                @include('backend.includes.components.page_invest.merchant_form')
            </div>
        </div>
    </div>
    <div class="main_wrapper main_history main_tabs_content">
        <div class="tabs_header">
            <button class="tabs_btn active" data-content="invest">@lang('cabinet_invest.invest_history.header')</button>
        </div>
        <div class="tabs_content">
            <div class="content invest active">
                @include('backend.includes.components.page_transactions.base_transactions', [
                'transactions' => $viewModel->getTransactions(\App\Models\Consts\TransactionsTypesConsts::ALL_INVEST_TYPES)[1]
                ])
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmInvest() {
            return confirm('{{trans('strings.backend.pages.invest.investConfirm')}}');
        }
    </script>
@endsection('scripts')