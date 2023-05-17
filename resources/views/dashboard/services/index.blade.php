@extends('dashboard.app')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    @include('dashboard.services.errors')
    @include('dashboard.services.messages')
    <!-- Header -->
    <div class="header">
        <div class="container-fluid">
            <div class="header-body pt-3">
                <h6 class="h2">{{$servicesCategoryTitle}}</h6>
            </div>
        </div>
    </div>

    <style>
        #form_services .custom-control-label {
            height: max-content;
        }
        #form_services .custom-control-input + label{
            font-size: 16px
        }
        #form_services .custom-control-input + label::before {
            line-height: 20px;
            text-align: center;
            width: 20px;
            height: 20px
        }
        #form_services .custom-control-input:checked + label::before {
            content: '\2713'
        }
    </style>

    <div class="container-fluid">
        <form id="form_services" method="POST" action="{{ route('home.services.booking') }}">
            @csrf
            <div class="row services-items">
                @foreach($listServices as $services)
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="custom-control custom-checkbox py-2">
                            <input
                                class="custom-control-input"
                                type="checkbox"
                                id="input_{{ $services['name_en'] }}"
                                name="{{ $services['name_en'] }}"
                                value="{{ $services['price_usd'] }}"
                            >
                            <input
                                type="hidden"
                                name="services_category"
                                value="{{$servicesCategory}}"
                            >
                            <label class="custom-control-label d-flex justify-content-between" for="input_{{ $services['name_en'] }}">
                                <span class="mr-2">{{ $services['name_ru'] }}</span>
                                <span class="h4">${{ $services['price_usd'] }}</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="h3 m-0 mb-2">
                Итого: $<span id="services_sum">0</span>
            </p>
            <div class="row">
                <div class="col-lg-8 col-md-10 col-12">
                    <div class="d-flex">
                        <input class="input-conclusion form-control mr-1"
                            required type="text"
                            maxlength="128"
                            size="64"
                            name="contact"
                            placeholder="@lang('base.dash.services.contacts')">
                        <button class="btn btn-primary btn-lg px-5 py-2" type="submit" form="form_services">@lang('dinway.btns.order')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/services/services.js')}}"></script>
@endsection


