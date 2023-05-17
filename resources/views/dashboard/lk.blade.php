@extends('dashboard.app')
@section('content')
    <!-- Header -->
    <div class="header pb-3 pb-3">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-3">Welcome to Monexo Dashboard</h6>
                    </div>
                </div>
                <!-- Card stats -->
                 <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.profile.profile')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.your_email')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$yourEmail}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.profile.profile')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.mentor')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$mentor}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.balance')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body ">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.total_supplements')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$allReplenishment}} USD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-active-40"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.marketing-plans.index')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body ">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.total_investments')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$totalInvestment}} USD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-chart-pie-35"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.balance')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body ">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.total_withdrawal')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$allWithdrawal}} USD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-money-coins"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.referrals')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body ">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.number_of_partners')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$quantityReferrals}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-chart-bar-32"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.marketing-plans.index')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body ">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.profit_investments')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$profitInvestment}} USD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-chart-bar-32"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.referrals')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body ">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.partner_profit')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$profitAffiliateProgram}} USD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-chart-bar-32"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.referrals')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body ">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.level_1_turnover')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$turnoverOneLine}} USD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-chart-bar-32"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('home.referrals')}}">
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-3">@lang('base.dash.home.profile-info.team_turnover')</h5>
                                            <span class="h2 font-weight-bold mb-0">{{$teamTurnover}} USD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape">
                                                <i style="color: #6425FE" class="ni ni-chart-bar-32"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        {{-- <a href="{{route('home.referrals')}}"> --}}
                            <div class="card card-stats pi-tile-small">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row flex-nowrap">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Send invitation</h5>
                                            @include('dashboard.partners.referral-invite')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
