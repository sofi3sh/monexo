@extends('auth.layout')

@section('content')
    <div class="container mt-8 pt-6 pb-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="text-white">@lang('base.verify.title')</h2>
                <p class="text-white">@lang('base.verify.text')
                    <a class="font-weight-bold text-white" href="{{ route('verification.resend') }}">@lang('base.verify.link')</a>
                </p>

                <form class="d-inline mt-6"
                      method="POST"
                      action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-white">@lang('base.verify.logout')</button>
                </form>
                <form class="d-inline  mt-6 ml-2"
                      method="POST"
                      action="{{ route('cancel.registration') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">@lang('base.verify.cancel_registration')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
