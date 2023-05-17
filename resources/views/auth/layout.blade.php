<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="@yield('description', 'Monexo – Reliable partner in the world of investments')">
  <meta name="keywords" content="@yield('keywords', 'Monexo, money, investment, инвестиции, доход, прибыль, деньги')">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('monexo/favicon-16x16.png')}}">

  <title>
    @if(isset($title))
      Monexo – {{ $title }}
    @else
      Monexo – @lang('base.title')
    @endif
  </title>
  <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css')}}">
  <link rel="stylesheet" href="{{ asset('script/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <!-- <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css"> -->
  <link rel="stylesheet" href="{{ asset('style/argon.css?v=1.2.1') }}" type="text/css">
  <style type="text/css">
    @font-face{font-family:Everett;src:url(/monexo/assets/Everett-Light-f3fc012f.woff2) format("woff2"),url(/assets/Everett-Light-c181bea1.ttf) format("truetype");font-weight:300;font-style:normal;font-display:swap}
    @font-face{font-family:Everett;src:url(/monexo/assets/Everett-Regular-bec49c43.woff2) format("woff2"),url(/assets/Everett-Regular-b5e9006c.ttf) format("truetype");font-weight:400;font-style:normal;font-display:swap}
    @font-face{font-family:Everett;src:url(/monexo/assets/Everett-Medium-f7af34e8.woff2) format("woff2"),url(/assets/Everett-Medium-66f2d110.ttf) format("truetype");font-weight:500;font-style:normal;font-display:swap}
    body{
        font-family: Everett;
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 24px;
        color: #2c2c2c;
        text-decoration: none;
        transition: all .3s ease-in
    }
    .logo__img{
      width: 120px !important;
      height: auto !important;
    }
    .rc-anchor{
      position: fixed;
      bottom: 60px;
    }
    .has-error {
      border: 1px solid red;
    }
    .invalid-feedback {
      display: block !important;
    }
    .mentor-title {
      color: white;
    }

    @media screen and (max-width: 992px) {
      .text-sm-dark {
        color: #000 !important;
      }
    }
    .custom-control-input + .custom-control-label::before {
      transition: background-color .3s;
    }
    .custom-control-input:checked + .custom-control-label::before {
      content: '\2713';
      text-align: center;
      padding-left: 1px;
      font-size: 12px;
    }
  </style>
  {!! htmlScriptTagJsApi() !!}
</head>

<body class="bg-gradient-green p-0 m-0">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="{{route('home.main')}}">
          <img src="{{ asset('monexo/images/logo.png') }}" alt="logo" class="logo__img"/>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a class="navbar-brand" href="{{route('home.main')}}">
                <img src="{{ asset('monexo/images/logo.png') }}" alt="logo" class="logo__img"/>
            </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="{{route('website.home')}}" class="nav-link">
              <span class="nav-link-inner--text">@lang('auth.header.home')</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('register')}}" class="nav-link">
              <span class="nav-link-inner--text">@lang('auth.header.registration')</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('login')}}" class="nav-link">
              <span class="nav-link-inner--text">@lang('auth.header.login')</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('reset.password')}}" class="nav-link">
              <span class="nav-link-inner--text">@lang('auth.header.password_recovery')</span>
            </a>
          </li>
        </ul>
        <div class="mr-3 text-light">
            <span class="text-uppercase">
                @lang('dinway.header.lang1')
            </span>
            /
            @foreach (config('locale.languages') as $lang)
                @if ($lang[0] != app()->getLocale() && $lang[4])
                        <a class="text-secondary text-sm-dark active" href="{{'lang/'.$lang[0]}}">{{strtoupper($lang[0])}}</a>
                @endif
            @endforeach
        </div>
        <a href="{{route('website.home')}}" class="btn btn-neutral btn-icon">
          <span class="btn-inner--icon">
            <i class="ni ni-tv-2"></i>
          </span>
          <span class="nav-link-inner--text">@lang('auth.header.back_to_the_main_page')</span>
        </a>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    @yield('content')
  </div>
  <!-- Footer -->
  <footer class="pt-5 pb-1" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-light">
            &copy; 2022 - {{Carbon\Carbon::now()->year}} <a href="/" class="font-weight-bold ml-1 text-white">Monexo</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="{{ route('website.home') }}" class="nav-link text-white">@lang('auth.header.home')</a>
            </li>
            <li class="nav-item">
              <a href="{{route('login')}}" class="nav-link text-white">@lang('auth.header.login')</a>
            </li>
            <li class="nav-item">
              <a href="{{route('register')}}" class="nav-link text-white">@lang('auth.header.registration')</a>
            </li>
            <li class="nav-item">
              <a href="{{route('reset.password')}}" class="nav-link text-white">@lang('auth.header.password_recovery')</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  @include('helpers.js-localisation')

  @section('js')
      <!-- Argon Scripts -->
      <!-- Core -->
      <script src="{{ asset('script/vendor/jquery/dist/jquery.min.js') }}"></script>
      <script src="{{ asset('script/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('script/vendor/js-cookie/js.cookie.js') }}"></script>
      <script src="{{ asset('script/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
      <script src="{{ asset('script/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
      <!-- Argon JS -->
      <script src="{{ asset('script/dashboard/argon.js?v=1.2.0.0511') }}"></script>
      <script src="{{ asset('js/intlTelInput-jquery.min.js')}}"></script>
      <script src="{{ asset('script/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
      <script src="{{ asset('js/form-validation.js') }}"></script>
      <script src="{{ asset('js/autocomplete/autocomplete.min.js')}}"></script>
      <script src="{{ asset('js/autocomplete/city-autocomplete.js')}}"></script>
  @show

</body>

</html>
