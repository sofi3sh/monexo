@extends('dashboard.app')


@section('content')
    <div class="container-fluid py-5">
        <h1 class="text-center">@lang('debts-info.page-title')</h1>
        @include('dashboard.debts-info')        
    </div>

@endsection
