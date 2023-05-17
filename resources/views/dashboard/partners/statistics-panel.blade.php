<!-- Card stats -->
<!-- <li class="mobile-user-level nav-item">
    <a href="{{route('home.referrals')}}" href="javascript:" class="nav-link">
        @lang('auth.level') <b>{{ Auth()->user()->bonus_level }}</b><br>
        (@lang('auth.achieved_level') <b>{{ Auth()->user()->achieved_bonus_level }}</b>)
    </a>
</li> -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('auth.level')</h5>
                        <span class="h2 font-weight-bold mb-0">{{ Auth()->user()->bonus_level }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('auth.achieved_level')</h5>
                        <span class="h2 font-weight-bold mb-0">{{ Auth()->user()->achieved_bonus_level }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('base.dash.home.profile-info.mentor')</h5>
                        <span class="h2 font-weight-bold mb-0">{{$mentor}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('base.dash.home.profile-info.country')</h5>
                        <span class="h2 font-weight-bold mb-0">{{$country}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('base.dash.home.profile-info.number_of_partners')</h5>
                        <span class="h2 font-weight-bold mb-0">{{$quantityReferrals}}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('base.dash.home.profile-info.partner_profit')</h5>
                        <span class="h2 font-weight-bold mb-0">{{$profitAffiliateProgram}} USD</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('base.dash.home.profile-info.level_1_turnover')</h5>
                        <span class="h2 font-weight-bold mb-0">{{$turnoverOneLine}} USD</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">@lang('base.dash.home.profile-info.team_turnover')</h5>
                        <span class="h2 font-weight-bold mb-0">{{$teamTurnover}} USD</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
