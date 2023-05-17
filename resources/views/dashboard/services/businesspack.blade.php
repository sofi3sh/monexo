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
        #promotion .custom-control-label {
            height: max-content;
        }
        #promotion .custom-control-input + label{
            font-size: 16px
        }
        #promotion .custom-control-input + label::before {
            line-height: 20px;
            text-align: center;
            width: 20px;
            height: 20px
        }
        #promotion .custom-control-input:checked + label::before {
            content: '\2713'
        }
    </style>


    <!-- Header -->
    <div class="header">
        <div class="container-fluid">
            <div class="header-body pt-3">
                <h1 class="h1 text-center">{{$servicesCategoryTitle}}</h1>
            </div>
        </div>
    </div>

    <div id="audit" class="container-fluid mb-3">
        <h2 id="title" class="h2">@lang('base.dash.services.businesspack.audit.title')</h2>
        <div class="row">
            <div class="col-lg-6 col-12">
                <p>@lang('base.dash.services.businesspack.audit.desc')</p>
            </div>
        </div>
        <div class="mb-2">
                <strong>@lang('base.dash.services.price')</strong>
                <span>$<span id="price">300</span></span>
                <span id="single" hidden>audit</span>
            </div>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_audit">@lang('base.dash.services.btns.more')</button>
        <button id="main_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_order">@lang('base.dash.services.btns.order')</button>
    </div>

    <div class="container-fluid">
        <h2 class="h2">@lang('base.dash.services.businesspack.promotion.title')</h2>
        <div id="promotion">
            <div class="row">
                @foreach ($listServices as $services)
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="custom-control custom-checkbox py-2">
                            {{-- Не разъединять  --}}
                            <input
                                class="custom-control-input"
                                type="checkbox"
                                id="input_{{ $services['name_en'] }}"
                                name="{{ $services['name_en'] }}"
                                value="{{ $services['price_usd'] }}"
                            >
                            <label class="custom-control-label d-flex justify-content-between" for="input_{{ $services['name_en'] }}">
                                <span class="mr-2">
                                    @if (app()->getLocale() == 'ru')
                                        {{ $services['name_ru'] }}
                                    @else
                                        {{ $services['name_english'] }}
                                    @endif
                                </span>
{{--                                <span class="mr-2">{{ $services['name_ru'] }}</span>--}}
                                <span class="h4">${{ $services['price_usd'] }}</span>
                            </label>
                            {{-- Не разъединять  --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-2">
                <strong>@lang('base.dash.services.summary') </strong>
                <span data-sum>$0</span>
            </div>
            <button data-toggle="modal" data-target="#modal_order" class="btn btn-primary" disabled>@lang('base.dash.services.btns.order')</button>
        </div>
    </div>

    <div class="modal fade" id="modal_audit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="ml-auto mt-2 mr-1 close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="modal-content" class="modal-body">
                    <div>@lang('dinway.modal-audit-info.analysis')</div>
                    <ul>
                        <li>@lang('dinway.modal-audit-info.item1')</li>
                        <li>@lang('dinway.modal-audit-info.item2')</li>
                        <li>@lang('dinway.modal-audit-info.item3')</li>
                        <li>@lang('dinway.modal-audit-info.item4')</li>
                        <li>@lang('dinway.modal-audit-info.item5')</li>
                        <li>@lang('dinway.modal-audit-info.item6')</li>
                    </ul>
                    <div class="modal-info__block strong">@lang('dinway.modal-audit-info.strategy')</div>
                    <ul>
                        <li>@lang('dinway.modal-audit-info.item7')</li>
                        <li>@lang('dinway.modal-audit-info.item8')</li>
                    </ul>
                    <div>@lang('dinway.modal-audit-info.result')</div>
                    <ul>
                        <li>@lang('dinway.modal-audit-info.item9')</li>
                    </ul>
                    <p class="text-sm">@lang('dinway.modal-audit-info.audit-info')</p>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.services.chunks.modal-order')
@endsection

