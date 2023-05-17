@extends('auth.layout')

@section('content')
    <style>
        input.verify-code::-webkit-inner-spin-button,
        input.verify-code::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
        input.verify-code {
            max-width: 150px;
            text-align: center;
            letter-spacing: 6px;
            font-size: 26px;
            line-height: 26px;
            height: 46px;
            margin: 10px auto;
            color: #172B4D;
        }
    </style>

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12" style="text-align: center;">
                <h2>@lang('base.verify_telegram.title')</h2>

                <div class="my-3">
                    <script async src="https://telegram.org/js/telegram-widget.js?14" data-telegram-login="{{env('TG_BOT_NAME')}}" data-size="large" data-auth-url="{{route('verification.telegram-action')}}" data-request-access="write"></script>
                </div>

                <form class="d-inline"
                      method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="btn btn-sm btn-outline-white">@lang('base.verify_phone.logout')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
