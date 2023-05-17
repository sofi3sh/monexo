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


    {{-- <div class="container-fluid">
        <h1 class="h1">Видеокурсы</h1>
    </div> --}}


    <div class="container-fluid mb-3">
        <div>
            <div id="course" class="mb-3">
                <h2 id="title" class="h2">MLM UP 2.0</h2>
                <p>@lang('base.dash.profi-universe.mlm_up_2_dot_0.descr')</p>
                <strong>@lang('base.dash.services.price')</strong>
                <span class="d-inline-block mr-2 mb-2">$<span id="price">90</span></span>
                <span id="single" hidden>video_courses</span>
                <div>
                    <a class="btn btn-secondary mb-2" href="{{ route('home.profi-universe') }}">@lang('base.dash.services.btns.go_to_course')</a>
                    {{-- Тут нужно поставить условие. Если курс оплачен - не выводить --}}
                    @if($paid == 0)
                    <button id="main_btn" type="button" data-toggle="modal" data-target="#modal_order" class="btn btn-primary mb-2">
                        @lang('dinway.blogtime.instruction.to-order')
                    </button>
                    @endif
                    <div>
                        <svg width="16" height="16">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#present"></use>
                        </svg>
                        <span>@lang('dinway.blogtime.instruction.telegram')</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('dashboard.services.chunks.modal-order')

    <script src="{{ asset('js/services/services.js')}}"></script>
@endsection


