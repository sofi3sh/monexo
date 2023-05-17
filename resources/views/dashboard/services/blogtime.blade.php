@extends('dashboard.app')

@section('css')
@endsection

@section('js')
    <script src="{{ asset('js/services/services.js')}}"></script>
@endsection

@section('content')
    @include('dashboard.services.errors')
    @include('dashboard.services.messages')

    <style>
        #form_promotion .custom-control-label {
            height: max-content;
        }
        #form_promotion .custom-control-input + label{
            font-size: 16px
        }
        #form_promotion .custom-control-input + label::before {
            line-height: 20px;
            text-align: center;
            width: 20px;
            height: 20px
        }
        #form_promotion .custom-control-input:checked + label::before {
            content: '\2713'
        }
    </style>

    <div class="header">
        <div class="container-fluid">
            <div class="header-body pt-3">
                <h1 class="h1 text-center">{{$servicesCategoryTitle}}</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-3">
        <div class="">
            <div id="pack" class="mb-3">
                <h2 id="title" class="h1">@lang('dinway.blogtime.instruction.instagram')</h2>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <h4 class="h2">@lang('dinway.blogtime.instruction.analysis')</h4>
                        <p>@lang('dinway.blogtime.instruction.analysis-descr')</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <h4 class="h2">@lang('dinway.blogtime.instruction.strategy')</h4>
                        <p>@lang('dinway.blogtime.instruction.strategy-descr')</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <h4 class="h2">@lang('dinway.blogtime.instruction.implementation')</h4>
                        <p>@lang('dinway.blogtime.instruction.implementation-descr')</p>
                    </div>
                </div>
                <span class="d-inline-block mr-2 mb-2">$<span id="price">400</span> / 1 @lang('base.dash.services.month')</span>
                <span id="single" hidden>instagram_packaging</span>
                <button id="main_btn" type="button" data-toggle="modal" data-target="#modal_order" class="btn btn-primary mb-2">
                    @lang('dinway.blogtime.instruction.to-order')
                </button>
                <div>
                    <svg width="16" height="16">
                        <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#present"></use>
                    </svg>
                    <span>@lang('dinway.blogtime.instruction.telegram')</span>
                </div>
            </div>
            <div id="escort" class="mb-3">
                <h2 id="title" class="h1">@lang('dinway.blogtime.instruction.instagram-escorts')</h2>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <h4 class="h2">@lang('dinway.blogtime.instruction.instagram-one')</h4>
                        <p>@lang('dinway.blogtime.instruction.instagram-one-descr')</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <h4 class="h2">@lang('dinway.blogtime.instruction.instagram-six')</h4>
                        <p>@lang('dinway.blogtime.instruction.instagram-six-descr')</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <h4 class="h2">@lang('dinway.blogtime.instruction.instagram-twelve')</h4>
                        <p>@lang('dinway.blogtime.instruction.instagram-twelve-descr')</p>
                    </div>
                </div>
                <div class="mb-3" id="radio-btns">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="one_month" data-name_en="instagram_escorts_month1" value="200" checked>
                        <label class="form-check-label" for="one_month">@lang('base.dash.services.periods.one')</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="six_months" data-name_en="instagram_escorts_month6" value="1000">
                        <label class="form-check-label" for="six_months">@lang('base.dash.services.periods.six')</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="twelve_months" data-name_en="instagram_escorts_month12" value="1800">
                        <label class="form-check-label" for="twelve_months">@lang('base.dash.services.periods.twelve')</label>
                    </div>
                </div>
                <span class="d-inline-block mr-2 mb-2">$<span>200</span> / 1 @lang('base.dash.services.month')</span>
                <button id="main_btn" type="button" data-toggle="modal" data-target="#modal_order" class="btn btn-primary mb-2">
                    @lang('dinway.blogtime.instruction.to-order')
                </button>
                <div>
                    <svg class="step-btns__info-img" width="16" height="16">
                        <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#present"></use>
                    </svg>
                    <span>@lang('dinway.blogtime.instruction.gift')</span>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.services.chunks.modal-order')

    <script src="{{ asset('js/services/services.js')}}"></script>
@endsection


