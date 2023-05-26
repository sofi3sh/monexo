@extends('dashboard.app')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@stop
@section('content')
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
@if(session('MaxPercent'))
<p>{{session('MaxPercent')}}</p>
@endif
<div class="header pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">@lang('base.dash.menu.investments')</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          {{-- <a href="#modalInvestment" data-toggle="modal" data-target="#modalInvestment" class="btn btn-sm btn-neutral">@lang('base.dash.menu.information')</a> --}}
        </div>
      </div>
      {{-- <div class="modal" id="modalInvestment" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="title_content">@lang('website_investments.header')</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="section">
                            <div class="about_top_content">
                                <div class="investors_right">
                                    <div class="about_top_content_text main_text">
                                        <p>
                                            @lang('website_investments.for_investors_section.p1')
                                            <div class="logo-wrapper pt-1 pb-2">
                                                <img class="image" style="padding-right:20px;max-width:24%;" src="{{asset('img/svg/icon-lamoda.svg')}}">
                                                <img class="image" style="padding-right:20px;max-width:24%;" src="{{asset('img/svg/icon-iherb.svg')}}">
                                                <img class="image" style="padding-right:20px;max-width:24%;" src="{{asset('img/svg/icon-monobank.svg')}}">
                                                <img class="image" style="padding-right:20px;max-width:24%;" src="{{asset('img/svg/icon-ritofos.svg')}}">
                                            </div>

                                            <p class="pt-1">
                                                @lang('website_investments.for_investors_section.p2')
                                            </p>
                                        <p>
                                            @lang('website_investments.for_investors_section.p3')
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- Це панелька з назвами пакетів --}}
            <div class="plans-section">
                <div class="row justify-content-center">
                    <div class="plan-tabs-wrapper">
                        @foreach($marketingPlanGroups['packages'] as $name => $some)
                            @foreach($marketingPlanGroups['cssClasses'] as $nameCss => $css)
                                @if($name == $nameCss)
                                    <div class="tab-switcher {{ $css }}">
                                        @if(strpos($name,'Light') !== false) Regular @endif
                                        @if(strpos($name,'Mini') !== false) Random @endif
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- Временно, это панелька с названиями пакетов --}}
                {{-- <div class="row justify-content-center">
                <div class="plan-tabs-wrapper">
                    @php
                        //$array = ['third active', 'four'];
                        //$array = ['third active', 'second','four'];
                        //$array = ['third active', 'second', 'first', 'four'];
                        //$array = ['first active', 'second', 'third', 'four', 'five'];
                        $array = ['first active', 'second d-none', 'third', 'four', 'five d-none'];
                        $serverIndex = 0;
                    @endphp
                    @foreach($marketingPlanGroups['packages'] as $name => $some)
                        @php
                            if (strpos($array[$loop->index],'d-none') !== false) continue;
                            $serverIndex++;
                        @endphp
                        <div class="tab-switcher {{ $array[$loop->index] }} ">
                            SERVER {{ $serverIndex }}
                        </div>
                    @endforeach
                </div>
            </div>--}}
            <div class="row">
                {{-- Light == Regular --}}
                <div class="col-12 plan plan-first justify-content-center active">
                    <div class="row justify-content-center">
                        @foreach($marketingPlanGroups['packages']['Light'] as $marketingPlanGroup)
                            <div class="col-auto">
                                <div class="card card-stats p-4">
{{--                                    <small class="text-center" style="margin-top:-0.7rem;">@lang('website_home.package.30_days_avg_income', ['from' => '5.5%', 'to' => '13.7%'])</small>--}}
                                    <div class="d-table ml-auto mr-auto pb-4 mt-2">
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3" style="width: 70%"><b>@lang('website_home.package.week_income', ['percent' => ''])</b></div>
                                            <div class="d-table-cell py-1  pr-3" style="width: 30%; white-space:nowrap">
                                                {{ $marketingPlanGroup->min_profit }} - {{ $marketingPlanGroup->max_profit }}%
                                            </div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.period', ['days'=> ''])</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.unlimited')</div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.force_close')</b></div>
                                            <div class="d-table-cell py-1 pr-3">0%, @lang('website_home.package.delay_days', ['days' => 25])</div>
                                        </div>
{{--                                        @dd($marketingPlanGroup->body_on)--}}
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.invest_body')</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.disable')</div>
                                        </div>
                                    </div>
                                    <form class="js-package js-package-{{ \App\Models\Home\MarketingPlan::GROUP_LIGHT }}">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-amount">@lang('website_home.package.sum'), $</label>
                                                    <input id="input-amount-range"
                                                           class="form-control"
                                                           type="number"
                                                           name="amountInput"
                                                           min="{{ $marketingPlanGroup->min_invest_sum }}"
                                                           max="{{ $marketingPlanGroup->max_invest_sum }}"
                                                           value="{{ $marketingPlanGroup->min_invest_sum }}"
                                                           step="1"
{{--                                                           oninput="this.form.amountRange.value=this.value"--}}
                                                    />
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div class="d-flex flex-row justify-content-center pb-4">--}}
{{--                                            <h4 class="mb-0 mr-2">${{ number_format($marketingPlanGroup->min_invest_sum, 0, '.', ' ') }}</h4>--}}
{{--                                            <input class="flex-grow-1 range"--}}
{{--                                                   type="range"--}}
{{--                                                   name="amountRange"--}}
{{--                                                   min="{{ $marketingPlanGroup->min_invest_sum }}"--}}
{{--                                                   value="{{ $marketingPlanGroup->min_invest_sum }}"--}}
{{--                                                   max="{{ $marketingPlanGroup->max_invest_sum }}"--}}
{{--                                                   step="1000"--}}
{{--                                                   oninput="this.form.amountInput.value=this.value" />--}}
{{--                                            <h4 class="mb-0 ml-2">${{ number_format($marketingPlanGroup->max_invest_sum, 0, '.', ' ') }}</h4>--}}
{{--                                        </div>--}}
                                    </form>

                                    <button class="investment-btn btn btn-sm btn-primary"
                                            data-amount="#input-amount-range"
                                            data-type="{{ $marketingPlanGroup->currency_type }}"
                                            data-id="{{ $marketingPlanGroup->id }}"
                                            data-name="Regular"
                                            data-toggle="modal"
                                            data-target="#investmentModal">
                                        @lang('base.dash.investments.package.button')
                                    </button>

                                    <!-- <a href="#" data-toggle="modal" data-target="#modal-guide-light" class="small mt-3 text-center">@lang('website_home.package.show_guide')</a> -->
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                {{-- Mini == Random --}}
                <div class="col-12 plan plan-second justify-content-center">
                    <div class="row justify-content-center">
                        @foreach($marketingPlanGroups['packages']['Mini'] as $marketingPlanGroup)
                            <div class="col-auto">
                                <div class="card card-stats p-4">
{{--                                    <small class="text-center" style="margin-top:-0.7rem;">@lang('website_home.package.30_days_avg_income_percent', ['percent' => '33%'])</small>--}}
                                    <div class="d-table ml-auto mr-auto pb-4 mt-2">
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3" style="width: 70%"><b>@lang('website_home.package.daily_income', ['percent' => ''])</b></div>
                                            <div class="d-table-cell py-1  pr-3" style="width: 30%; white-space:nowrap">
                                                {{ $marketingPlanGroup->min_profit }} - {{ $marketingPlanGroup->max_profit }}%
                                            </div>
                                        </div>
{{--                                        <div class="d-table-row">--}}
{{--                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.period', ['days'=> ''])</b></div>--}}
{{--                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.period_days', ['days'=> 220])</div>--}}
{{--                                        </div>--}}
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.force_close')</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.no')</div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.invest_body')</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.enable')</div>
                                        </div>
                                    </div>
                                    <form class="js-package js-package-{{ \App\Models\Home\MarketingPlan::GROUP_MINI }}">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                           for="input-amount">@lang('website_home.package.sum'),
                                                        $</label>
                                                    <input id="input-amount-range-2" class="form-control" type="number"
                                                           name="amountInput"
                                                           min="{{ $marketingPlanGroup->min_invest_sum }}"
                                                           max="{{ $marketingPlanGroup->max_invest_sum }}"
                                                           value="{{ $marketingPlanGroup->min_invest_sum }}"
                                                           step="1"
{{--                                                           oninput="this.form.amountRange.value=this.value"--}}
                                                    />
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div class="d-flex flex-row justify-content-center pb-4">--}}
{{--                                            <h4 class="mb-0 mr-2">$20</h4>--}}
{{--                                            <input class="flex-grow-1 range" type="range" name="amountRange" min="{{ $marketingPlanGroup->min_invest_sum }}" max="{{ $marketingPlanGroup->max_invest_sum }}" value="{{ $marketingPlanGroup->min_invest_sum }}" step="10" oninput="this.form.amountInput.value=this.value" />--}}
{{--                                            <h4 class="mb-0 ml-2">$10 00000</h4>--}}
{{--                                        </div>--}}
                                    </form>

                                    <button class="investment-btn btn btn-sm btn-primary"
                                            data-amount="#input-amount-range-2"
                                            data-type="{{ $marketingPlanGroup->currency_type }}"
                                            data-id="{{ $marketingPlanGroup->id }}"
                                            data-name="Random"
                                            data-toggle="modal"
                                            data-target="#investmentModal">
                                        @lang('base.dash.investments.package.button')
                                    </button>

                                    <!-- <a href="#" data-toggle="modal" data-target="#modal-guide-mini" class="small mt-3 text-center">@lang('website_home.package.show_guide')</a> -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Standard --}}
                {{-- <div class="col-12 plan plan-first justify-content-center active">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="card card-stats p-4">
                                <div class="d-table ml-auto mr-auto pb-4 mb-2 mt-2">
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3" style="width: 70%"><b>@lang('website_home.package.daily_income', ['percent' => ''])</b></div>
                                        <div class="d-table-cell py-1  pr-3" style="width: 30%"><span id="plan-profit">0.95</span>%</div>
                                    </div>
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.period', ['days'=> ''])</b></div>
                                        <div class="d-table-cell py-1 pr-3">@lang('website_home.package.period_days', ['days'=> 200])</div>
                                    </div>
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.force_close')</b></div>
                                        <div class="d-table-cell py-1 pr-3">@lang('website_home.package.no')</div>
                                    </div>
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.invest_body')</b></div>
                                        <div class="d-table-cell py-1 pr-3">@lang('website_home.package.enable')</div>
                                    </div>
                                </div>

                                @foreach($marketingPlanGroups['packages']['Standard'] as $index => $marketingPlanGroup)
                                    @php
                                        $indexActive = $userMarketingPlanStandardActive && $userMarketingPlanStandardActive->marketing_plan_id === $marketingPlanGroup->id ? $index : 0;
                                    @endphp
                                    @if($indexActive != 0)
                                        @break
                                    @endif
                                @endforeach

                                <div class="d-flex flex-row justify-content-center flex-wrap">
                                    @foreach($marketingPlanGroups['packages']['Standard'] as $index => $marketingPlanGroup)
                                    <div class="form_radio_btn">
                                        <input id="radio-{{ $index + 1 }}" type="radio" data-profit="{{ $marketingPlanGroup->daily_percent }}" name="radio" value="{{ $index + 1 }}" @if($index === $indexActive) checked @endif>
                                        <label for="radio-{{ $index + 1 }}">${{ $marketingPlanGroup->max_invest_sum }}</label>
                                    </div>
                                    @if($index === 2)
                                </div>
                                <div class="d-flex flex-row justify-content-center flex-wrap pb-4">
                                    @endif
                                    <br>
                                    @endforeach
                                </div>

                                @php /** @var $userMarketingPlanStandardActive \App\Models\Home\UserMarketingPlan */ @endphp
                                @php /** @var $userMarketingPlanBusinessActive \App\Models\Home\UserMarketingPlan */ @endphp
                                @foreach($marketingPlanGroups['packages']['Standard'] as $index => $marketingPlanGroup)
                                    @php
                                        $btnClass = 'js-btn-submit js-btn-submit-' . ($index + 1);
                                        if ($index !== $indexActive) {
                                            $btnClass .= ' d-none';
                                        }
                                    @endphp

                                    @if($userMarketingPlanStandardActive && $userMarketingPlanStandardActive->marketing_plan_id === $marketingPlanGroup->id)
                                        <button class="investment-btn btn btn-sm btn-primary {{ $btnClass }}" disabled>
                                            <strong>@lang('website_home.package.active_plan')</strong>
                                        </button>
                                    @else
                                        @if($userMarketingPlanStandardActive)
                                            @if($userMarketingPlanStandardActive->marketingPlan->max_invest_sum > $marketingPlanGroup->min_invest_sum)
                                                <button class="investment-btn btn btn-sm btn-primary {{ $btnClass }}" disabled>
                                                    @lang('website_home.package.downgrade_impossible')
                                                </button>
                                            @else
                                                <button class="investment-btn btn btn-sm btn-primary {{ $btnClass }}" data-upgrade="true" data-amount="{{ $marketingPlanGroup->max_invest_sum - $userMarketingPlanStandardActive->marketingPlan->max_invest_sum }}" data-id="{{ $marketingPlanGroup->id }}" data-name="SERVER 1" data-toggle="modal" data-target="#investmentModal">
                                                    @lang('website_home.package.upgrade')
                                                </button>
                                            @endif
                                        @else
                                            <button class="investment-btn btn btn-sm btn-primary {{ $btnClass }}" data-amount="{{ $marketingPlanGroup->min_invest_sum }}" data-id="{{ $marketingPlanGroup->id }}" data-name="SERVER 1" data-toggle="modal" data-target="#investmentModal">
                                                @lang('base.dash.investments.package.button')
                                            </button>
                                        @endif
                                    @endif
                                @endforeach

                                <!-- <a href="#" data-toggle="modal" data-target="#modal-guide-standard" class="small mt-3 text-center">@lang('website_home.package.show_guide')</a> -->
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- Новый вид пакета CryptoBusiness --}}
                {{-- <div class="col-12 plan plan-second justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="card card-stats p-4 ">
                                <small class="text-center" style="margin-top:-0.7rem;">@lang('website_home.package.30_days_avg_income', ['from' => '8%', 'to' => '24%'])</small>
                                <div class="d-table ml-auto mr-auto pb-4 mb-2 mt-22">
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3" style="width: 70%"><b>@lang('website_home.package.week_income', ['percent' => ''])</b></div>
                                        <div class="d-table-cell py-1  pr-3" style="width: 30%; white-space:nowrap">2 - 6%</div>
                                    </div>
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.period', ['days'=> ''])</b></div>
                                        <div class="d-table-cell py-1 pr-3">@lang('website_home.package.period_days', ['days'=> 200])</div>
                                    </div>
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.force_close')</b></div>
                                        <div class="d-table-cell py-1 pr-3">12.5%</div>
                                    </div>
                                    <div class="d-table-row">
                                        <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.invest_body')</b></div>
                                        <div class="d-table-cell py-1 pr-3">@lang('website_home.package.disable')</div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center flex-wrap mb-3">
                                    @foreach($marketingPlanGroups['packages']['CryptoBusiness'] as $index => $marketingPlanGroup)
                                        <div class="form_radiocrypto_btn">
                                            <input id="radio-{{ $marketingPlanGroup->id }}"
                                                type="radio"
                                                data-crypto="{{ strtoupper($marketingPlanGroup->currency_type) }}"
                                                data-min="{{ $marketingPlanGroup->min_invest_sum }}"
                                                data-max="{{ $marketingPlanGroup->max_invest_sum }}"
                                                name="radiocrypto"
                                                value="1"
                                                @if($index === 0) checked @endif
                                                data-type="{{ $marketingPlanGroup->currency_type }}"
                                                data-id="{{ $marketingPlanGroup->id }}"
                                                data-name="{{ $marketingPlanGroup->name }}"
                                            >
                                            <label for="radio-{{ $marketingPlanGroup->id }}">{{ strtoupper($marketingPlanGroup->currency_type) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <form class="js-crypto-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-amount">@lang('website_home.package.sum'), $</label>
                                                <input class="form-control" type="number" name="amountInput" min="500" max="100000" value="500" step="0.1" oninput="this.form.amountRange.value=this.value" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-currency" id="label-currency">BTC</label>
                                                <input id="input-currency" name="currency" type="number" min="0" max="1000000" value="0" step="0.001" class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center pb-4">
                                        <h4 class="mb-0 mr-2 js-crypto-range-from">$500</h4>
                                        <input class="flex-grow-1 range js-crypto-range" type="range" name="amountRange" min="500" max="100000" value="500" step="0.1" oninput="this.form.amountInput.value=this.value" />
                                        <h4 class="mb-0 ml-2 js-crypto-range-to">$100 000</h4>
                                    </div>
                                </form>

                                <button class="investment-btn invest-crypto btn btn-sm btn-primary js-crypto-form-submit"
                                        data-type=""
                                        data-id=""
                                        data-name=""
                                        data-toggle="modal"
                                        data-target="#investmentModalCrypto"
                                >@lang('base.dash.investments.package.button')</button>

                                <!-- <a href="#" data-toggle="modal" data-target="#modal-guide-cryptobusiness" class="small mt-3 text-center">@lang('website_home.package.show_guide')</a> -->
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- Новый вид пакета New Light временно убран plan-third --}}
                {{-- <div class="col-12 plan plan-five justify-content-center">
                    <div class="row justify-content-center">
                        @php //$newLight = $marketingPlanGroups['packages']['New Light'][0] @endphp
                        @foreach($marketingPlanGroups['packages']['New Light'] as $newLight)
                            <div class="col-auto">
                                <div class="card card-stats p-4">
                                    <small class="text-center" style="margin-top:-0.7rem;">Еженедельная прибыль: {{($newLight->min_profit + $newLight->max_profit) / 2 }}%</small>
                                    <div class="d-table ml-auto mr-auto pb-4 mt-2">
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.period', ['days'=> ''])</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.unlimited')</div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.force_close')</b></div>
                                            <div class="d-table-cell py-1 pr-3">0%, @lang('website_home.package.delay_days', ['days' => 25])</div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.invest_body')</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.disable')</div>
                                        </div>
                                    </div>
                                    <form class="js-package js-package-{{ \App\Models\Home\MarketingPlan::GROUP_NEW_LIGHT }}">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-amount">@lang('website_home.package.sum'), $</label>
                                                    <input id="input-amount-range"
                                                           class="form-control"
                                                           type="number"
                                                           name="amountInput"
                                                           min="{{ $newLight->min_invest_sum }}"
                                                           max="{{ $newLight->max_invest_sum }}"
                                                           value="{{ $newLight->min_invest_sum }}"
                                                           oninput="this.form.amountRange.value=this.value" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-center pb-4">
                                            <h4 class="mb-0 mr-2">${{ number_format($newLight->min_invest_sum, 0, '.', ' ') }}</h4>
                                            <input class="flex-grow-1 range"
                                                   type="range"
                                                   name="amountRange"
                                                   min="{{ $newLight->min_invest_sum }}"
                                                   value="{{ $newLight->min_invest_sum }}"
                                                   max="{{ $newLight->max_invest_sum }}"
                                                   oninput="this.form.amountInput.value=this.value" />
                                            <h4 class="mb-0 ml-2">${{ number_format($newLight->max_invest_sum, 0, '.', ' ') }}</h4>
                                        </div>
                                    </form>

                                    <button class="investment-btn btn btn-sm btn-primary"
                                            data-amount="#input-amount-range"
                                            data-type="{{ $newLight->currency_type }}"
                                            data-id="{{ $newLight->id }}"
                                            data-name="{{ $newLight->name }}"
                                            data-toggle="modal"
                                            data-target="#investmentModal">
                                        @lang('base.dash.investments.package.button')
                                    </button>

                                    <!-- <a href="#" data-toggle="modal" data-target="#modal-guide-new-light" class="small mt-3 text-center">@lang('website_home.package.show_guide')</a> -->
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div> --}}

                {{-- Новый вид пакета Business ... plan-first  plan-third-old --}}
                {{-- <div class="col-12 plan plan-third justify-content-center">
                    <div class="row justify-content-center">
                        @foreach($marketingPlanGroups['packages']['Business'] as $marketingPlanGroup)
                            <div class="col-auto">
                                <div class="card card-stats p-4">
                                    <small class="text-center" style="margin-top:-0.7rem;">@lang('website_home.package.30_days_avg_income', ['from' => '20%', 'to' => '28%'])</small>
                                    <div class="d-table ml-auto mr-auto pb-4 mt-2">
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3" style="width: 70%"><b>@lang('website_home.package.week_income', ['percent' => ''])</b></div>
                                            <div class="d-table-cell py-1  pr-3" style="width: 30%; white-space:nowrap">5 - 7%</div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.period', ['days'=> ''])</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.period_days', ['days'=> '∞'])</div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.force_close')</b></div>
                                            <div class="d-table-cell py-1 pr-3">15%</div>
                                        </div>
                                        <div class="d-table-row">
                                            <div class="d-table-cell pr-3 py-2 pl-3"><b>@lang('website_home.package.invest_body')</b></div>
                                            <div class="d-table-cell py-1 pr-3">@lang('website_home.package.disable')</div>
                                        </div>
                                    </div>
                                    <form class="js-package js-package-{{ \App\Models\Home\MarketingPlan::GROUP_BUSINESS }}">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-amount">@lang('website_home.package.sum'), $</label>
                                                    <input id="input-amount-range-3"
                                                           class="form-control"
                                                           type="number"
                                                           name="amountInput"
                                                           min="{{ $marketingPlanGroup->min_invest_sum }}"
                                                           max="{{ $marketingPlanGroup->max_invest_sum }}"
                                                           value="{{ $marketingPlanGroup->min_invest_sum }}"
                                                           step="1"
                                                           oninput="this.form.amountRange.value=this.value" />
                                                    @if($userMarketingPlanBusinessActive)
                                                        <div style="color:#777;font-size:12px;">
                                                            @lang('website_home.package.business_sum_input_description', ['sum' => '$' . $userMarketingPlanBusinessActive->invested_usd])
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-center pb-4">
                                            <h4 class="mb-0 mr-2">${{ number_format($marketingPlanGroup->min_invest_sum, 0, '.', ' ') }}</h4>
                                            <input class="flex-grow-1 range"
                                                   type="range"
                                                   name="amountRange"
                                                   min="{{ $marketingPlanGroup->min_invest_sum }}"
                                                   value="{{ $marketingPlanGroup->min_invest_sum }}"
                                                   max="{{ $marketingPlanGroup->max_invest_sum }}"
                                                   step="10"
                                                   oninput="this.form.amountInput.value=this.value" />
                                            <h4 class="mb-0 ml-2">$25 000</h4>
                                        </div>
                                    </form>

                                    <button class="investment-btn btn btn-sm btn-primary"
                                            data-amount="#input-amount-range-3"
                                            data-type="{{ $marketingPlanGroup->currency_type }}"
                                            data-id="{{ $marketingPlanGroup->id }}"
                                            data-name="SERVER 2"
                                            data-toggle="modal"
                                            data-target="#investmentModal">
                                        @if($userMarketingPlanBusinessActive)
                                            @lang('website_home.package.upgrade')
                                        @else
                                            @lang('base.dash.investments.package.button')
                                        @endif
                                    </button>

                                    <!-- <a href="#" data-toggle="modal" data-target="#modal-guide-business" class="small mt-3 text-center">@lang('website_home.package.show_guide')</a> -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
  </div>
</div>


<script>
    function accept_invest(){
        $('.investment-package form span').text('');
        $('.investment-package form div').text('');
        let arr = document.querySelectorAll('.investment-package');
        for(let i = 0; i < arr.length; i++){
            arr[i].style.display = 'none';
        }
        //arr[a].style.display = 'flex';
        //document.querySelector('close-package').style.display = 'inline';
    }
    function close_accept(){
        let arr = document.querySelectorAll('.investment-package');
        for(let i = 0; i < arr.length; i++){
            arr[i].style.display = 'none';
        }
    }
</script>


<div class="container-fluid">
    <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header border-0">
              <h3 class="mb-0">@lang('base.dash.investments.table.title')</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-New Light">
                  <tr>
                    <th scope="col">@lang('base.dash.investments.table.date')</th>
                    <th scope="col">@lang('base.dash.investments.table.package')</th>
                    <th scope="col">@lang('base.dash.investments.table.amount')</th>
                    <th scope="col">@lang('base.dash.investments.table.profit')</th>
                    <th scope="col">@lang('base.dash.investments.table.status')</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                    @foreach($marketingPlans->sortByDesc('id') as $item)
                        @php
                            $codeInvested = 'invested_'.$item->marketingPlan->currency_type;
                            $codeProfit = 'profit_'.$item->marketingPlan->currency_type;
                        @endphp
                        <tr>
                            <th>{{$item->created_at}}</th>
                            <td>
                                @if(isset($item->marketingPlan->name))
{{--                                    @if(strpos($item->marketingPlan->name,'Standard') !== false) SERVER 1 @endif--}}
{{--                                    @if(strpos($item->marketingPlan->name,'Business') !== false) SERVER 2 @endif--}}
                                    @if(strpos($item->marketingPlan->name,'Light') !== false) Regular @endif
                                    @if(strpos($item->marketingPlan->name,'Mini') !== false) Random @endif
                                @endif
                                {{-- (isset($item->marketingPlan->name)) ? $item->marketingPlan->name : '' --}}
                            </td>
                            <td>{{$item->$codeInvested}} {{strtoupper($item->marketingPlan->currency_type)}}</td>
                            <td>{{$item->$codeProfit}} {{strtoupper($item->marketingPlan->currency_type)}}</td>
                            @if($item->isStopped())
                                <td class="text-warning">
                                    {{ __('website_home.package.stopped') }}
                                </td>
                            @else
                                <td class="{{!is_null($item->end_at)?'text-warning':'text-success'}}">
                                    {{is_null($item->end_at)? __('base.dash.investments.table.yes') : __('base.dash.investments.table.no')}}
                                </td>
                            @endif
                            <td>
                                @if(!$item->end_at && !$item->marketingPlan->isUnlimitedDuration())
                                    @lang('website_home.package.end_date'):<br>{{\Carbon\Carbon::now()->addDays($item->days_left)->format('d.m.Y')}}<br>
                                @endif
                                @if($item->id)
                                    @if ($item->marketingPlan->isUnlimitedDuration() && $item->isStopped())
                                        @lang('website_home.package.stopped'):<br>{{\Carbon\Carbon::now($item->stopped_at)->format('d.m.Y')}}<br>
                                    @endif
                                    @if(!$item->isStopped() && $item->marketingPlan->available_for_withdrawal == 1 && is_null($item->end_at) && $item->days_left > 30)
                                        @if (
                                            (float)$item->$codeProfit &&
                                            (
                                                $item->marketingPlan->isNewByIdAndName(\App\Models\Home\MarketingPlan::GROUP_BUSINESS) ||
                                                $item->marketingPlan->isNewByIdAndName(\App\Models\Home\MarketingPlan::GROUP_CRYPTO_BUSINESS) ||
                                                $item->marketingPlan->isNewByIdAndName(\App\Models\Home\MarketingPlan::GROUP_NEW_LIGHT) ||
                                                $item->marketingPlan->isNewByIdAndName(\App\Models\Home\MarketingPlan::GROUP_MINI) ||
                                                $item->marketingPlan->isNewByIdAndName(\App\Models\Home\MarketingPlan::GROUP_LIGHT)
                                            )
                                        )
                                            <a href="{{ route('home.marketing-plans.invest.withdraw', ['id' => $item->id]) }}" class="invest-withdraw">@lang('website_home.package.package_withdraw')</a><br>
                                        @endif
                                        <a href="javascript:;" class="close-investment-btn" data-withdrawal_commission="{{$item->marketingPlan->withdrawal_commission}}" data-id="{{$item->id}}">{{__('base.dash.investments.close')}}</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    {{-- Modals --}}
    <div id="modal-guide-cryptobusiness" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">@lang('website_home.guide.title') CryptoBusiness</div>
                <div class="modal-body">
                    @lang('website_home.guide.package_cryptobusiness')
                    <button class="btn btn-primary js-decline-close-investment" data-dismiss="modal">@lang('website_home.guide.close')</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-guide-business" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">@lang('website_home.guide.title') SERVER 2</div>
                <div class="modal-body">
                    @lang('website_home.guide.package_business')
                    <button class="btn btn-primary js-decline-close-investment" data-dismiss="modal">@lang('website_home.guide.close')</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-guide-standard" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">@lang('website_home.guide.title') SERVER 1</div>
                <div class="modal-body">
                    @lang('website_home.guide.package_standard')
                    <button class="btn btn-primary js-decline-close-investment" data-dismiss="modal">@lang('website_home.guide.close')</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-guide-mini" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">@lang('website_home.guide.title') SERVER 3</div>
                <div class="modal-body">
                    @lang('website_home.guide.package_mini')
                    <button class="btn btn-primary js-decline-close-investment" data-dismiss="modal">@lang('website_home.guide.close')</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-guide-new-light" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">@lang('website_home.guide.title') New Light</div>
                <div class="modal-body">
                    @lang('website_home.guide.package_new_light')
                    <button class="btn btn-primary js-decline-close-investment" data-dismiss="modal">@lang('website_home.guide.close')</button>
                </div>
            </div>
        </div>
    </div>

    <div id="closeInvestment" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">@lang('base.dash.investments.confirm.confirmation')</div>
                <div class="modal-body">
                    <p>@lang('base.dash.investments.confirm.commission') <b id="label-withdrawal_commission">8%</b></p>
                    <form id="close-investment-form" action="{{route('home.marketing-plans.close.with.commision')}}" method="POST">
                        @csrf
                        <input type="hidden" name="marketing_plan_id" id="marketing-plan-id">
                    </form>
                    <button class="btn btn-danger js-decline-close-investment" data-dismiss="modal">@lang('base.dash.investments.confirm.no')</button>
                    <button class="btn btn-success" form="close-investment-form">@lang('base.dash.investments.confirm.close')</button>
                </div>
            </div>
        </div>
    </div>

    <div id="investmentModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <span style="font-weight: bold; font-size: 16px;">@lang('notifications.package.alert') <span class="package-name"></span></span>
            <button type="button" class="close" style="padding: 5px;" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="invest-usd-form" action="{{route('home.marketing-plans.invest')}}" method="POST">
              @csrf
              <div style="display: none;" id="modal-upgrade-text"><strong>@lang('website_home.package.upgrade_description')</strong></div>
              <label id="label-usd">$<span id="label-usd-value">0</span></label>
              <input for="label-usd" type="range" step="10" min="0" class="form-control" placeholder="@lang('base.dash.investments.package.amount_ph')" name="invest_usd">
              <input type="hidden" name="marketing_plan_id" class="marketing_plan_id">
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default invest-btn" data-form="invest-usd-form">@lang('base.dash.investments.package.button')</button>
          </div>
        </div>
      </div>
    </div>

    <div id="investmentModalCrypto" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <span style="font-weight: bold; font-size: 16px;">@lang('notifications.package.alert') <span class="package-name"></span></span>
            <button type="button" class="close" style="padding: 5px;" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           <form id="invest-crypto-form" action="{{route('home.marketing-plans.invest.crypto')}}" method="POST">
             @csrf
               <label><span id="modal-crypto-amount">0</span> <span id="modal-crypto-currency"></span></label>
               <input type="hidden" name="invest_crypto" id="modal-crypto-input-invest_crypto">
             <input type="hidden" name="marketing_plan_id" class="marketing_plan_id">
             <input type="hidden" name="currency_type" class="currency_type">
           </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default invest-btn" data-form="invest-crypto-form">@lang('base.dash.investments.package.button')</button>
          </div>
        </div>

      </div>
    </div>

    <div id="confirm-invest" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @lang('notifications.package.alert') <span class="package-name"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('notifications.package.cancel')</button>
                    <button class="btn btn-danger btn-ok">@lang('notifications.package.buy')</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        var btc = "{{Auth()->user()->getCurrencyeUsd('bitcoin')}}";
        var eth = "{{Auth()->user()->getCurrencyeUsd('ethereum')}}";
        var pzm = "{{Auth()->user()->getCurrencyeUsd('prizm')}}";

        //
        // crypto
        //
        var curMap = {
            BTC: btc,
            ETH: eth,
            PZM: pzm
        }
        $('[name="radiocrypto"]').change(function() {
            $('.js-crypto-form [name="amountInput"]').val(0);
            $('.js-crypto-form [name="amountInput"]').trigger('input');
            $('#input-currency').trigger('input');
            $('#input-currency').trigger('focusout');

            var $formSubmit = $('.js-crypto-form-submit');
            $formSubmit.data('id', $(this).data('id'));
            $formSubmit.data('type', $(this).data('type'));
            $formSubmit.data('name', $(this).data('name'));

            curMap[$('[name="radiocrypto"]:checked').data('crypto')]

            var minSum = $(this).data('min') * curMap[$(this).data('crypto')],
                maxSum = $(this).data('max') * curMap[$(this).data('crypto')];

            $('.js-crypto-range').attr('min', minSum);
            $('.js-crypto-range').attr('max', maxSum);
            $('.js-crypto-range-from').text('$' + parseInt(minSum));
            $('.js-crypto-range-to').text('$' + parseInt(maxSum));
        });
        $('.js-crypto-form [name="amountRange"]').on('change input', function () {
            $('.js-crypto-form [name="amountInput"]').trigger('input');
        });
        $('.js-crypto-form [name="amountInput"]').on('input', function () {
            $('#input-currency').val($(this).val() / curMap[$('[name="radiocrypto"]:checked').data('crypto')]);
        });
        $('#input-currency').on('input', function() {
            $('.js-crypto-form [name="amountInput"]').val($(this).val() * curMap[$('[name="radiocrypto"]:checked').data('crypto')]);
        });
        $('.js-crypto-form [name="amountInput"], #input-currency').on('focusout', function () {
            var $inputUSD = $('.js-crypto-form [name="amountInput"]');
            // if ($inputUSD.val() < 500) {
            //     $inputUSD.val(500);
            // } else if ($inputUSD.val() > 100000) {
            //     $inputUSD.val(100000);
            // }

            var $selected = $('[name="radiocrypto"]:checked');
            var $inputCrypto = $('#input-currency');
            if ($inputCrypto.val() < $selected.data('min')) {
                $inputCrypto.val($selected.data('min'))
            } else if ($inputCrypto.val() > $selected.data('max')) {
                $inputCrypto.val($selected.data('max'))
            }

            $inputCrypto.trigger('input');
            $inputUSD.trigger('input');
        });
        $('.form_radiocrypto_btn:first-child [name="radiocrypto"]').trigger('change');

        $('.js-package [name="amountInput"]').on('focusout', function () {
            var $parent = $(this).closest('.js-package');
            var $inputUSD = $parent.find('[name="amountInput"]');
            var $range = $parent.find('[name="amountRange"]');
            if (parseInt($inputUSD.val()) < parseInt($range.attr('min'))) {
                $inputUSD.val($range.attr('min'));
            } else if (parseInt($inputUSD.val()) > parseInt($range.attr('max'))) {
                $inputUSD.val($range.attr('max'));
            }
            $inputUSD.trigger('input');
        });

        var $inputAmount = $('#invest-usd-form [name="invest_usd"]');
        $inputAmount.on('change input', function () {
            $('#label-usd-value').text($(this).val());
        });

        $('#invest-usd-form').submit(function () {
            $('#confirm-invest .btn-ok').prop('disabled', true);
        });

        $('#close-investment-form').submit(function () {
            $('#closeInvestment [form="close-investment-form"]').prop('disabled', true);
        });

        $(document).off('click', '.investment-btn').on('click', '.investment-btn', function(){
          // Для модальних вікон
          // Всі дата-атрибути передаються з кнопки пакету і передаються до модального вікна
          $('.package-name').text($(this).data('name'));
          $('.marketing_plan_id').val($(this).data('id'));
          $('.currency_type').val($(this).data('type'));

          var btnAmount = 0;
          if (Number.isInteger($(this).data('amount'))) {
              btnAmount = parseInt($(this).data('amount'));
          } else {
              var $amountRangeInput = $($(this).data('amount'));
              btnAmount = $amountRangeInput.val();
          }

            if ($(this).data('upgrade')) {
                $('#modal-upgrade-text').fadeIn();
            } else {
                $('#modal-upgrade-text').fadeOut();
            }

            if (btnAmount > 0) {
                $inputAmount.prop('type', 'hidden');
                $inputAmount.val(btnAmount);
                $inputAmount.trigger('change');
                return;
            } else {
                $inputAmount.val(0);
                $inputAmount.prop('readonly', false);
            }

            var btnMin = parseInt($(this).data('min'));
            if (btnMin > 0) {
                $inputAmount.val(btnMin);
                $inputAmount.attr('min', btnMin);
            } else {
                $inputAmount.attr('min', 0);
            }

            var btnMax = parseInt($(this).data('max'));
            if (btnMax > 0) {
                $inputAmount.attr('max', btnMax);
                $inputAmount.attr('type', 'range');
            }

            $inputAmount.trigger('change');
        })
        $(document).off('change keyup', '.btc-value').on('change keyup', '.btc-value', function(){
            if ($(this).val().trim() != '') {
                if ($('#invest-crypto-type').val() == 'usd') {
                    var val = parseFloat($(this).val());
                    val = val/btc;
                    if (val < 0.1 || val > 10) {
                        $('.invalid-error-message-btc').text('Пожалуйста, введите правильную сумму.');
                    }else {
                        $('.invalid-error-message-btc').text('');
                    }
                    $('.invested-crypto-usd-value').text(' = BTC '+val.toFixed(8));
                }else {
                    var val = $(this).val();
                    if (val < 0.1 || val > 10) {
                        $('.invalid-error-message-btc').text('Пожалуйста, введите правильную сумму.')
                    }else {
                        $('.invalid-error-message-btc').text('');
                    }
                    val = $(this).val()*btc;
                    $('.invested-crypto-usd-value').text(' = $'+val);
                }
            }else {
                $('.invested-crypto-usd-value').text('');
            }
        })
        $(document).off('change keyup', '.eth-value').on('change keyup', '.eth-value', function(){
            if ($(this).val().trim() != '') {
                if ($('#invest-crypto-type').val() == 'usd') {
                    var val = parseFloat($(this).val());
                    val = val/eth;
                    if (val < 0.1 || val > 250) {
                        $('.invalid-error-message-eth').text('Пожалуйста, введите правильную сумму.')
                    }else {
                        $('.invalid-error-message-eth').text('');
                    }
                    $('.invested-crypto-usd-value').text(' = ETH '+val.toFixed(8));
                }else {
                    var val = $(this).val();
                    if (val < 0.1 || val > 250) {
                        $('.invalid-error-message-eth').text('Пожалуйста, введите правильную сумму.')
                    }else {
                        $('.invalid-error-message-eth').text('');
                    }
                    val = $(this).val()*eth;
                    $('.invested-crypto-usd-value').text(' = $'+val);
                }
            }else {
                $('.invested-crypto-usd-value').text('');
            }
        })
        $(document).off('change keyup', '.pzm-value').on('change keyup', '.pzm-value', function(){
            if ($(this).val().trim() != '') {
                if ($('#invest-crypto-type').val() == 'usd') {
                    var val = parseFloat($(this).val());
                    val = val/pzm;
                    if (val < 100 || val > 500000) {
                        $('.invalid-error-message-pzm').text('Пожалуйста, введите правильную сумму.')
                    }else {
                        $('.invalid-error-message-pzm').text('');
                    }
                    $('.invested-crypto-usd-value').text(' = PZM '+val.toFixed(8));
                }else {
                    var val = $(this).val();
                    if (val < 100 || val > 500000) {
                        $('.invalid-error-message-pzm').text('Пожалуйста, введите правильную сумму.')
                    }else {
                        $('.invalid-error-message-pzm').text('');
                    }
                    val = $(this).val()*pzm;
                    $('.invested-crypto-usd-value').text(' = $'+val);
                }
            }else {
                $('.invested-crypto-usd-value').text('');
            }
        })
        $(document).off('change', '#invest-crypto-type').on('change', '#invest-crypto-type', function(){
            $('.currency_type').val($(this).val());
            $('.invested-crypto-usd-value').text('')
            $('.invest-crypto-input').val('').attr('placeholder', 'Сумма '+$(this).val().toUpperCase())
        })
        $('#btc-tarif').on('submit', function(){
            $('.btn-investment').attr('disabled', true);
            $('.btn-investment').addClass('disabled-btn');
        })
        $('#eth-tarif').on('submit', function(){
            $('.btn-investment').attr('disabled', true);
            $('.btn-investment').addClass('disabled-btn');
        })
        $('#pzm-tarif').on('submit', function(){
            $('.btn-investment').attr('disabled', true);
            $('.btn-investment').addClass('disabled-btn');
        })

        var $modalCloseInvest = $('#closeInvestment');
        $('.close-investment-btn').on('click', function(){
            $('#label-withdrawal_commission').text($(this).data('withdrawal_commission') + '%');
            //$('#closeInvestment').css('display','block');
            $modalCloseInvest.modal('show');
            var id = $(this).data('id');
            $('#marketing-plan-id').val(id);
        })

        $('.js-decline-close-investment').on('click', function () {
            $modalCloseInvest.modal('hide');
        });

        $(document).off('click', '.invest-crypto').on('click', '.invest-crypto', function(){
          var type = $(this).data('type');
          $('#modal-crypto-currency').text(type.toUpperCase());
          $('#modal-crypto-amount').text($('#input-currency').val());
          $('#modal-crypto-input-invest_crypto').val($('#input-currency').val());
          $('.invest-crypto-input').attr('placeholder', 'Сумма '+type.toUpperCase())
          $('.invest-crypto-input').removeClass('btc-value');
          $('.invest-crypto-input').removeClass('eth-value');
          $('.invest-crypto-input').removeClass('pzm-value');
          $('.invest-crypto-input').addClass(type+'-value');

          $('#invest-crypto-type').html('').prepend('<option value="'+type+'">'+type.toUpperCase()+'</option><option value="usd">USD</option>').addClass(type+'-value');
        })
        /*$(document).off('click', '.btn-ok').on('click', '.btn-ok', function(){
          $('#invest-usd-form').submit();
        })*/
        $(document).off('click', '.invest-btn').on('click', '.invest-btn', function(event){
          $('.btn-ok').attr('form', $(this).data('form'));
          $('#confirm-invest').modal('show');
        })

        /*
         *   Standart - переключение % по пакетам
         */

        @if(isset($indexActive))
        $('#plan-profit').text($('#radio-{{ $indexActive + 1 }}').data('profit'));
        @endif
        $(document).on('change', '.form_radio_btn input', function(){
            var btnIndex = $(this).val();
            $('.js-btn-submit').addClass('d-none');
            $('.js-btn-submit-' + btnIndex).removeClass('d-none');
            $('#plan-profit').text($(this).data('profit'));
        })

        /*
         *  CryptoBusiness - переключение криптовалют
         */

        $(document).on('change', '.form_radiocrypto_btn input', function(){

            $('#label-currency').text($(this).data('crypto'));
        })

        /* Блокировка форм при сабмите */

        $('form').each((index, form) => {
            $(form).submit(event => {
                if ($(form).attr('disabled')) {
                    event.preventDefault();

                    return;
                }

                $(form).attr('disabled', true);
            });
        });
    })

    // var modal = document.getElementById("closeInvestment");
    //
    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];
    //
    // var span1 = document.getElementsByClassName("decline-close-investment")[0];
    //
    //
    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //   modal.style.display = "none";
    // }
    //
    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal) {
    //     modal.style.display = "none";
    //   }
    // }

    $('.first').click(function(){
        $('.second_text').hide();
        $('.third_text').hide();
        $('.four_text').hide();
        $('.first_text').show();
    })
    $('.second').click(function(){
        $('.first_text').hide();
        $('.third_text').hide();
        $('.four_text').hide();
        $('.second_text').show();
    })
    $('.third').click(function(){
        $('.second_text').hide();
        $('.first_text').hide();
        $('.four_text').hide();
        $('.third_text').show();
    })
    $('.four').click(function(){
        $('.second_text').hide();
        $('.first_text').hide();
        $('.third_text').hide();
        $('.four_text').show();
    })
    $.fn.centerMe = function (parent) {
        this.css('left', parent.width()/2 - $(this).width()/2);
    };
    $('.plan-switcher').click(function(){

        var heights = $("div.card").map(function ()
        {
            return $(this).height();
        }).get();

        maxHeight = Math.max.apply(null, heights);

        $('div.card').each(function (index, value) {
            $(value).css('height',maxHeight)
            $('.investment-btn').css('position','absolute');
            content = $(value).find('.investment-btn').detach();
            $(value).append(content)
            $('.investment-btn').css('bottom','10px');
            $('.investment-btn').css('width','80%');
            $('.investment-btn').css('left','50%');
            $('.investment-btn').css('margin-left',-(($(value).width()/100*18)/2)+'px');

        });
    })
</script>
@stop
