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
                <h2>@lang('base.verify_phone.title')</h2>

                <p style="color: white;">@lang('base.verify_phone.text', ['phone_number' => strMasking(auth()->user()->phone)])
                    <a style="color: #172B4D;" href="{{ route('verification.phone-resend') }}">@lang('base.verify_phone.link')</a>
                </p>

                @if ($errors->has('code'))
                    <strong class="text-danger">{{ $errors->first('code') }}</strong>
                @endif

                <form action="{{ route('verification.phone-verify') }}" method="POST">
                    @csrf
                    {{ method_field('patch') }}
                    <input type="text" name="code" class="form-control verify-code" maxlength="{{ config('auth.phone_verification_code.length') }}">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="isRemember"
                               name="remember" {{ old('remember') ? 'checked="checked"' : '' }}>
                        <label class="form-check-label text-white" for="isRemember">
                            @lang('auth.phone_verify.remember')
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">@lang('auth.phone_verify.confirm')</button>
                </form>

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
