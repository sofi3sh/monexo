@extends('auth.layout', ['title' => __('website_auth.reset_password.title')])
{{-- Секция сброса пароля после перехода по ссылке из почты. --}}
@section('page', __('website_auth.reset_password.title'))
@section('content')
    <div class="container mt-8 pb-5">
        <div class="row justify-content-center pt-3">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>@lang('website_auth.reset_password.title')</small>
                        </div>
                        <form role="form" action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" name="password" min="8" placeholder="@lang('website_auth.reset_password.password')" type="password">
                                    <p class="invalid-feedback"></p>
                                    <p class="text-success"></p>
                                </div>

                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" name="password_confirmation" min="8" placeholder="@lang('website_auth.reset_password.password-confirm')" type="password">
                                    <p class="invalid-feedback"></p>
                                    <p class="text-success"></p>
                                </div>

                                @include('includes.partials.messages')
                                @if($errors->any())
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first() }}</strong></span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-green text-white mt-4">@lang('auth.password_recovery.change_password')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
