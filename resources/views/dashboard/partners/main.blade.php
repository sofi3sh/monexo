@extends('dashboard.app')

@section('css')
    <link href="{{ asset('css/partners.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('js/partners.js') }}"></script>
@endsection

@section('content')

@php($regionalRepresentativeStatusAvailable = auth()->user()->userBonus->is_regional_representative_status_available ?? 0)
@php($isUserHasRegionalRepresentativeStatus = auth()->user()->is_regional_representative)

<!-- Header -->
<div class="header bg-gradient-green pb-6">
    <div class="container-fluid">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">
                <p>{{ session()->get('success') }}</p>
                <p>{{ session()->get('email') }}</p>
                <p>{{ session()->get('package') }}</p>
                <p>{{ session()->get('depositAmount') }}</p>
            </div>
        @endif

        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@lang('base.dash.menu.partners')</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button class="btn btn-sm btn-neutral"
                            data-toggle="modal"
                            data-target="#modalInfo">
                        @lang('base.dash.menu.information')
                    </button>
                </div>
                {{-- <div class="col-12 text-center">
                    <button id="regional-representative-status"
                            {!! $isUserHasRegionalRepresentativeStatus ? '' : 'data-toggle="modal"' !!}
                            {!! $isUserHasRegionalRepresentativeStatus ? '' : ($regionalRepresentativeStatusAvailable ? 'data-target="#regional-representative-available-modal"' : 'data-target="#regional-representative-inactive-modal"' )!!}
                            class="btn {!! $isUserHasRegionalRepresentativeStatus ? 'confirmed' : ($regionalRepresentativeStatusAvailable ? 'available' : 'inactive') !!}">
                        <span>@lang('base.dash.partners.regional_representative')</span>
                        <small>@lang($isUserHasRegionalRepresentativeStatus ? 'base.dash.partners.confirmed' : ($regionalRepresentativeStatusAvailable ? 'base.dash.partners.available' : 'base.dash.partners.not_available'))</small>
                    </button>
                </div> --}}
                @include('dashboard.partners.modal-info')
            </div>
        @include('dashboard.partners.statistics-panel')
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    @if(optional(auth()->user()->userBonus)->is_invitation_deposit_available)
        <div class="row">
            <div class="col">
                @include('dashboard.partners.invitation-deposits-panel')
            </div>
        </div>
    @endif

    <!-- Dark table -->
    <div class="row">
        <div class="col">
            @include('dashboard.partners.partners-emails')

            {{-- @include('dashboard.partners.partners-map-buy') --}}
            {{-- @include('dashboard.partners.referral-invite') --}}

            {{-- @include('dashboard.partners.chart-statistics') --}}

            {{-- @include('dashboard.partners.chart-statistics') --}}

            @include('dashboard.partners.referral-tree')

            {{ $refferralsRecursive->links() }}
            <div class="clearfix" style="margin-bottom: 25px;"></div>
            <div class="clearfix" style="margin-bottom: 20px;"></div>

     <a href="#rules-career"
               data-toggle="collapse"
               role="button"
               aria-expanded="false"
               aria-controls="rules-career">@lang('website_careers.table.table_title')</a>

            @include('dashboard.partners.rules-career')

{{--            <img src="{{ asset('monexo/partners-en.svg') }}" style="width: 100%; overflow-x: auto" class="my-4">--}}

            <div class="clearfix" style="margin-bottom: 22px;"></div>
        </div>
    </div>
</div>
@endsection


