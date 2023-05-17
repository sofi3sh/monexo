@extends('auth.layout', ['title' => __('auth.header.login')])
@section('page', $page)
@section('content')
    <!-- Page content -->
    <div class="container mt-8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 py-3">
            <div class="card-body px-3 py-3">
              @if(isset($user_refer))
                <p class="mentor-title">
                  @lang('base.dash.home.profile-info.mentor_lower'): <b>{{$user_refer->name . ' ' . $user_refer->surname}}</b>
                </p>
              @endif
              <div class="text-muted text-center pt-2 pb-2"><small>@lang('auth.login.login_with')</small></div>
              <div class="btn-wrapper text-center pb-5">
                <a href="{{route('website.redirect.google')}}" class="btn btn-white btn-icon">
                  <span class="btn-inner--icon"><img src="{{ asset('images/google.svg') }}"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
              <div class="text-center text-muted pb-3">
                <small>@lang('auth.login.or_login_lp')</small>
              </div>
              <form id="form-auth" role="form" action="{{ route('login') }}" method="POST">
                @csrf
                <input type="hidden" name="toPage" value="{{$toPage}}">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative {{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text pr-2"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input id="form-email" class="form-control pl-1" name="email" placeholder="@lang('auth.login.email')" value="{{ old('email') }}" type="email">
                  </div>
                    <span class="invalid-feedback" role="alert">
                      @if ($errors->has('email'))
                        <strong>{{ $errors->first('email') }}</strong>
                      @endif
                    </span>
                </div>
                <div class="form-group mb3">
                  <div class="input-group input-group-merge input-group-alternative {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text pr-2"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control pl-1" name="password" placeholder="@lang('auth.login.password')" type="password">
                  </div>
                    <span class="invalid-feedback" role="alert">
                      @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                      @endif
                    </span>
                </div>
                <!-- <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                  {!! app('captcha')->display() !!}
                  @if ($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                  @endif
                </div> -->
                <!-- <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Запомнить меня</span>
                  </label>
                </div> -->
                <div class="text-center">
                  <button id="form-submit" type="submit" class="btn bg-gradient-green px-5 disabled text-white">@lang('auth.login.button')</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{route('reset.password')}}" class="text-white"><small>@lang('auth.login.f_psw')</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="{{route('register')}}" class="text-white"><small>@lang('auth.login.register')</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
