@extends('auth.layout', ['title' => __('auth.header.registration')])
@section('page', $page)

@section('content')
  <link rel="stylesheet" href="{{asset('css/autocomplete.min.css')}}">

    <style>
      .iti-form-country .iti--allow-dropdown .iti__flag-container, .iti-form-country .iti--separate-dial-code .iti__flag-container {
        right: 0;
      }
      .iti-form-country .iti__dial-code {
        display: none;
      }
      #form-country {
        background-color: #fff;
      }

      .autocomplete > div {
        padding: 3px;
      }

      .autocomplete>div.selected, .autocomplete>div:hover:not(.group) {
          background: rgba(0,0,0,0.1);
          color: var(--dark);
          cursor: pointer;
      }
      .autocomplete > div.selected {
        color: var(--white) !important;
        background-color: var(--blue) !important;
      }

      .autocomplete > div:hover {
        color: var(--white);
        background-color: rgba(0, 0, 0, 0.3)
      }

    </style>
    <!-- Page content -->
    <div class="container mt-8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-header bg-transparent pb-3 pt-4">
              @if(isset($user_refer))
                <p class="mentor-title text-dark text-center font-weight-bold">
                  @lang('base.dash.home.profile-info.mentor_lower'): <b>{{$user_refer->name . ' ' . $user_refer->surname}}</b>
                </p>
              @endif
            </div>
            <div class="card-body px-lg-3 py-lg-3">
              <div class="text-muted text-center mt-2 mb-4"><small>@lang('auth.register.login_with')</small></div>
              <div class="text-center">
                <a href="{{route('website.redirect.google')}}" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="{{ asset('images/google.svg') }}"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
              <div class="text-center text-muted mb-4">
                <small>@lang('auth.register.or_login_lp')</small>
              </div>
              <form id="form-register" role="form" action="{{ route('register') }}" method="POST">
                @csrf
                <input name="refer" type="hidden" value="{{$refer}}">
                <input name="user_refer" type="hidden" value="{{$user_refer}}">
                @if($depositAmount)
                  <input name="deposit-amount" type="hidden" value="{{$depositAmount}}">
                @endif
                @if($package)
                  <input name="package" type="hidden" value="{{$package}}">
                @endif
                @if($referralDepositId)
                    <input name="referral_deposit_id" type="hidden" value="{{$referralDepositId}}">
                @endif
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text px-2"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input id="form-name" class="form-control pl-1 pl-1" name="name" value="{{ old('name') }}" placeholder="@lang('auth.register.name')" type="text">
                  </div>
                  <span class="invalid-feedback strong" role="alert">
                    @if ($errors->has('name'))
                      {{ $errors->first('name') }}
                    @endif
                  </span>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3 {{ $errors->has('surname') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text px-2"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input id="form-name" class="form-control pl-1 pl-1" name="surname" value="{{ old('surname') }}" placeholder="@lang('auth.register.surname')" type="text">
                  </div>
                  <span class="invalid-feedback strong" role="alert">
                    @if ($errors->has('surname'))
                      {{ $errors->first('surname') }}
                    @endif
                  </span>
                </div>
                <div class="form-group iti-form-country">
                  <div class="input-group input-group-merge input-group-alternative mb-3 {{ $errors->has('country') ? ' has-error' : '' }}">
                    <input id="form-country" class="pl-5 form-control pl-1" name="country" value="{{ old('country') }}" placeholder="@lang('auth.register.country')" type="text" readonly>
                  </div>
                    <span class="invalid-feedback" role="alert">
                      @if ($errors->has('country'))
                        <strong>{{ $errors->first('country') }}</strong>
                      @endif
                    </span>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3 {{ $errors->has('city') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text px-2"><i class="ni ni-pin-3"></i></span>
                    </div>
                    <input id="form-city" class="form-control pl-1" name="city" value="{{ old('city') }}" placeholder="@lang('auth.register.city')" type="text">
                  </div>
                    <span class="invalid-feedback" role="alert">
                      @if ($errors->has('city'))
                        <strong>{{ $errors->first('city') }}</strong>
                      @endif
                    </span>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text px-2"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input id="form-birthday" class="form-control pl-1" name="birthday" value="{{ old('birthday') }}" placeholder="27.12.1996" type="text">
                  </div>
                  <span class="invalid-feedback strong" role="alert">
                    @if ($errors->has('birthday'))
                      {{ $errors->first('birthday') }}
                    @endif
                  </span>
                </div>
                @if($referralEmail)
                  <input type="hidden" name="email" value="{{$referralEmail}}">
                @else
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                      <div class="input-group-prepend">
                        <span class="input-group-text px-2"><i class="ni ni-email-83"></i></span>
                      </div>
{{--                        <input id="form-email" class="form-control pl-1" name="email" value="{{ old('email') }}" placeholder="@lang('auth.register.email')"type="email">--}}
                      <input
                          id="form-email"
                          class="form-control pl-1"
                          name="email"
                          @if($referralNewEmail)
                          value="{{$referralNewEmail}}"
                          @else
                          value="{{ old('email') }}"
                          @endif
                          placeholder="@lang('auth.register.email')"
                          type="email"
                          @if($referralNewEmail) readonly @endif>
                    </div>
                      <span class="invalid-feedback" role="alert">
                        @if ($errors->has('email'))
                          <strong>{{ $errors->first('email') }}</strong>
                        @endif
                      </span>
                  </div>
                @endif
                <!-- <div class="form-group">
                  <div class="input-group  input-group-alternative mb-3  {{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input id="form-phone" class="form-control" value="{{ old('phone') }}" placeholder="9999999999" type="text">
                    <input type="hidden" value="{{ old('phone') }}" name="phone" id="form-phone-hidden">
                  </div>
                    <span class="invalid-feedback" role="alert">
                        @if ($errors->has('phone'))
                          <strong>{{ $errors->first('phone') }}</strong>
                        @endif
                    </span>
                </div> -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text px-2"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="form-password" class="form-control pl-1" name="password" placeholder="@lang('auth.register.password')" type="password" min="8">
                  </div>
                  <span class="invalid-feedback" role="alert">
                    @if ($errors->has('password'))
                      <strong>{{ $errors->first('password') }}</strong>
                    @endif
                  </span>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text px-2"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="form-password-confirm" class="form-control pl-1 pl-1" name="password_confirmation" placeholder="@lang('auth.register.rst_password')" type="password" min="8" disabled>
                  </div>
                  <span class="invalid-feedback" role="alert"></span>
                </div>
                <div class="row my-4">
                  <div class="col-12">
                    <p class="text-sm text-dark">
                      @lang('auth.register.terms.read')
                      <a class="link text-sm" href="{{ route('website.dinway-agreement')}}">@lang('auth.register.terms.rules')</a>
                    </p>
                    <div class="form-group">
                        <div class="custom-control custom-control-alternative custom-checkbox">
                          <input class="custom-control-input" id="form-rules-use" type="checkbox" required="">
                          <label class="custom-control-label" for="form-rules-use">
                            @lang('auth.register.terms.start')
                            @lang('auth.register.terms.end')
                          </label>
                          <span class="invalid-feedback" role="alert"></span>
                        </div>
                    </div>
                  </div>
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
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-green mt-3">
                    @lang('auth.register.button')
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  @if(count($errors))
      <div class="modal fade" id="errorsModal" tabindex="-1" role="dialog" aria-labelledby="Errors" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">@lang('auth.register.errors')</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      @foreach($errors->default->getMessages() as $array)
                          @foreach($array as $message)
                              <p>{{$message}}</p>
                          @endforeach
                      @endforeach
                  </div>
                  <div class="modal-footer">

                      <div class="modal-footer">

                          @if(count($errors) and $errors->has('email'))
                              <a class="btn btn-primary" role="button" href="{{ route('register.query.email') }}">@lang('auth.btns.query_email')</a>
                          @endif
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('auth.btns.close')</button>
                  </div>
              </div>
          </div>
      </div>
  @endif
@endsection

@section('js')
    @parent
    @if(count($errors))
        <script>
            $('#errorsModal').modal('show');
        </script>
    @endif
@endsection
