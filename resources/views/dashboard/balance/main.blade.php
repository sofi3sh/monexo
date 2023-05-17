@extends('dashboard.app')

@section('css')
    <link href="{{ asset('css/balance.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js" integrity="sha512-sR3EKGp4SG8zs7B0MEUxDeq8rw9wsuGVYNfbbO/GLCJ59LBE4baEfQBVsP2Y/h2n8M19YV1mujFANO1yA3ko7Q==" crossorigin="anonymous"></script>
{{-- TODO DW-659 объявить тут перепенные с комсой --}}
<script>
    let withdrawalCommission = {{$commission}};
    let withdrawalLimits = {!! json_encode($withdrawalLimits) !!}
</script>
<script src="{{ asset('js/balance/withdrawal.js') }}" defer></script>
<script src="{{ asset('js/balance/payment.js') }}" defer></script>
{{-- <script>
    @if ($errors->any())
        $('#userToUserModal').modal('show');
    @endif
</script> --}}
<script>
    $('.balanceTabs a').click(function() {
        $('#withdrawTab, #paymentTab').hide();
        $('#' + $(this).data('tab')).show();
        return false;
    });
</script>

{{--<script src="{{ asset('js/balance/exchange.js') }}" defer></script>--}}
@endsection

@section('content')
    @include('dashboard.balance.errors')
    @include('dashboard.balance.messages')

    <!-- Header -->
    <div class="header bg-gradient-green pb-6">
        <div class="container-fluid">
            @include('dashboard.balance.header')
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12 order-2">
                {{-- @include('dashboard.balance.debt-swap') --}}
                @include('dashboard.balance.last-operation')
            </div>
            {{-- <div class="col-12 order-2">
                @include('dashboard.balance.user-to-user')
            </div> --}}
            <div class="col-12 order-2">
{{--                @include('dashboard.balance.exchange')--}}
            </div>
            <div class="col-xl-12 balanceTabs" style="margin-bottom: -6px;position: relative;">
                <a class="btn btn-sm btn-neutral" data-tab="paymentTab" style="padding-bottom: 12px;">@lang('base.dash.balance.replenish_balance')</a>
                <a class="btn btn-sm btn-neutral" data-tab="withdrawTab" style="padding-bottom: 12px;">@lang('base.dash.balance.withdraw')</a>
            </div>
            <div style="@if(app('request')->input('tab') === 'withdraw') display: none @endif" id="paymentTab" class="col-xl-12 order-xl-1 payin">
                @include('dashboard.balance.payment')
            </div>
            <div style="@if(app('request')->input('tab') === 'withdraw') display: block @endif" id="withdrawTab" class="col-xl-12 order-xl-1 payout">
                @include('dashboard.balance.withdrawal')
            </div>
        </div>
    </div>
    @include('dashboard.balance.modals-user-to-user')
    @include('dashboard.balance.withdrawal-modal-descr')
    @include('dashboard.balance.withdrawal-modal')
{{--    @include('dashboard.balance.exchange-modal')--}}
@endsection
