@extends('auth.layout', ['title' => __('auth.header.password_recovery')])
@section('page', $page)
@section('content')
    <div class="container mt-8 pb-5 pt-6">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>@lang('auth.password_recovery.change_password')</small>
              </div>
              <form id="form-reset-password" role="form" action="{{route('website.password.reset')}}" method="POST">
                @csrf
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input id="form-email" class="form-control" name="email" placeholder="@lang('auth.password_recovery.email')" type="email">
                  </div>
                  <p class="invalid-feedback"></p>
                  <p class="text-success"></p>
                  @if($errors->any())
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first() }}</strong>
                  </span>
                  @endif
                  @if(session()->has('message'))
                    <div class="alert alert-success">
                      <strong> {{ session()->get('message') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="text-center">
                  <button id="form-submit" type="submit" class="btn bg-gradient-green mt-4 text-white">@lang('auth.password_recovery.change_password')</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
