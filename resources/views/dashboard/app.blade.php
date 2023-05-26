<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Monexo">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css')}}">
    <link rel="icon" href="{{ asset('monexo/favicon-16x16.png') }}" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <script src="{{ asset('script/vendor/jquery/dist/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('script/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('script/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('script/vendor/animate.css/animate.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('script/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('style/argon.css?v=1.2.1.2810') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/css/jquery.treegrid.min.css" type="text/css">

    @include('helpers.js-localisation')
    <style type="text/css">
        /* ref popup */
        .b-ref-popup {}

        .b-ref-popup__text {
            position: relative;
            color: #999;
            margin-bottom: 9px;
            font-weight: 500;
        }

        .b-ref-popup__icon {
            position: absolute;
            top: 4px;
        }

        .b-ref-popup__hint {
            font-size: 14px;
            margin-left: 23px;
        }

        .b-ref-popup__link {
            overflow: hidden;
        }

        /* notify */
        [data-notify="container"] {
            width: 320px;
        }

        [data-notify="icon"] {
            vertical-align: middle;
            margin-right: 2px;
        }

        .white-active,
        .header-lang__link {
            display: inline-block;
            color: white;
        }

        .header-lang__link {
            text-decoration: underline;
        }

        .header-lang__link:hover {
            color: white;
            opacity: 0.8;
        }

        .alert-message-notification {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }

        .user-level {
            cursor: pointer;
            color: white;
            font-weight: 500;
            box-shadow: 1px 1px 7px white;
            padding: 5px;
            border: 1px solid white;
            border-radius: 5px;
            transition: 0.3s;
        }

        .user-level:hover {
            transform: scale(1.05);
        }

        .mobile-user-level {
            /*display: none;*/
        }

        .display-none {
            display: none !important;
        }

        @media only screen and (max-width: 750px) {
            #navbar-search-main {
                display: none;
            }
        }

        @media only screen and (max-width: 900px) {
            .user-level {
                display: none;
            }

            .mobile-user-level {
                display: block;
            }
        }

        /* start Некликабельность для пунктов меню */
        .unclick {
            position: relative;
        }
        .unclick::after {
            content: '';
            position: absolute;
            left: -200px;
            top: 0;
            bottom: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.5);
        }
        /* end Некликабельность для пунктов меню */

        .nav-item {
            white-space: nowrap;
            margin-top: 0 !important;
        }

        .primary-item {
            background-color: #dde2ff;
        }

        .primary-item a {
            font-weight: 700 !important;
        }

        @media screen and (max-width: 450px) {
            .header-nav-list li {
                font-size: 12px !important;
            }

            .header-nav-list .nav-link {
                padding: 0 10px !important;
            }

            .avatar {
                font-size: 14px !important;
                padding: 0 !important;
                width: 14px !important;
                height: 14px !important;
                margin-top: -5px;
            }
        }

    </style>
    <style>
        .alert {
            margin-bottom: 0;
        }
        .treegrid-expander {
            vertical-align: super;
        }
        .balans-form__item {
            position: relative;
            cursor: pointer;
            line-height: 1;
        }

        .balans-form__item input {
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;

            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            cursor: pointer;
            opacity: 0;
        }

        .balans-form__content {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: center;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8px;
        }

        .balans-form__item input:checked+.balans-form__content {
            background-color: #5E72E4;
            border-radius: 8px;
            color: #fff;
        }

        .balans-form__item:not(.dis):hover .balans-form__content {
            background-color: #5E72E4;
            border-radius: 8px;
            color: #fff;
        }

        .balans-form__item.dis {
            opacity: 0.5;
        }

        .balans-form__pic img {
            height: 40px;
        }

        .payout {
            display: none;
        }




        .investment-line img {
            width: auto !important;
        }

        .title-package {
            width: 100%;
        }

        .disabled-crypto {
            opacity: 0.7;
            pointer-events: none;
        }

        .disabled-img {
            opacity: 0;
        }

        .investment-packages {
            width: 100%;
        }

        .btc-to-usd,
        .eth-to-usd,
        .pzm-to-usd {
            font-weight: bold;
            font-size: 14px;
        }

        .invalid-error-message-btc,
        .invalid-error-message-eth,
        .invalid-error-message-pzm {
            font-size: 10px;
            padding: 0;
            margin: 0;
            color: red;
            font-weight: bold;
            height: 10px;
        }

        .disabled-btn {
            opacity: 0.8;
            pointer-events: none;
        }

        .close-investment {
            padding-left: 25px;
        }

        .close-investment a {
            color: red;
            background: white;
            border: 1px solid red;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            padding: 0px 10px;
            transition: 0.3s;
        }

        .close-investment a:hover {
            color: white;
            background: red;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .tabs-container {
            max-width: 100%;
            padding: 0;
        }

        .table thead {
            background: #5b4e9e;
            color: white;
        }

        table.dataTable th.dt-center,
        table.dataTable td.dt-center,
        table.dataTable td.dataTables_empty {
            padding: 5px;
            font-size: 16px;
            text-align: left;
            padding: 5px 20px;
        }

        .dataTables_wrapper .dataTables_info {
            font-size: 16px;
            font-weight: 500;
            margin-left: 10px;
        }

        .dataTables_wrapper .dataTables_paginate {
            font-size: 16px;
        }

        .dataTables_wrapper .dataTables_paginate a {
            margin: 0 5px;
            background: #ffffff !important;
            border: 1px solid #292929 !important;
            border-radius: 50px !important;
        }

    </style>

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
    </style>
    @yield('css')
</head>

<body class="bg-gradient-green">
    {{-- aside menu --}}
    @include('dashboard.chunks.aside')

    <!-- Main content -->
    <div class="main-content bg-gradient-green pl-3" id="panel">
        @if($showVerifInfo)
            <div class="alert alert-warning mb-2" style="font-size: 14px">
                @lang('errors.verif')
            </div>
        @else
            @if(!Auth::user()->is_verif && $user->debt_usd > 0)
                <div class="alert alert-warning mb-2" style="font-size: 14px">
                    @lang('errors.verif-info', [
                        'href' => route('home.profile.profile')
                    ])
                </div>
            @else
                @if(Auth::user()->is_verif)
                <div class="alert alert-success mb-2" style="font-size: 14px; color: #155724">
                    @lang('success.verif-info')
                </div>
                @endif
            @endif
        @endif

        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center header-nav-list ml-0 mr-2">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="px-2 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown ml-0">
                            <div class="header-lang">
                                <div class="active white-active" data-lang="en" href="#">
                                    {{ strtoupper(app()->getLocale()) }}</div>
                                @foreach (config('locale.languages') as $lang)
                                    @if ($lang[0] != app()->getLocale() && $lang[4])
                                        <span style="margin: 0 1px; color: #fff;"> | </span>
                                        <a data-lang="{{ $loop->index }}" href="{{ '/lang/' . $lang[0] }}"
                                            class="header-lang__link">{{ strtoupper($lang[0]) }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>

                        @if(!empty($alerts[0]))
                            <li id="alerts-dropdown" class="nav-item">
                                <a class="nav-link py-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="position: relative"
                                >
                                    <i class="ni ni-bell-55"></i>
                                    <span class="bg-warning alerts-count"
                                            style="position: absolute; top: 0; left: calc(100% - 14px); font-size: 10px; padding: 0px 3px; border-radius: 3px"
                                            id="alerts-count">@if($alerts[0]->viewed === 0) {{$alerts_count}} @endif</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-left py-0 overflow-hidden ml-2">
                                    <a class="text-dark" href="{{route('home.alerts') . '#notifications'}}">
                                        <ul id="alerts-list" class="list-group list-group-flush ml-2">
                                            @foreach ($alerts as $alert)
                                                <li class="list-group-item @if($loop->last)border-bottom-0 @endif">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <div>
                                                                <small>{{$alert->human_date}}</small>
                                                            </div>
                                                            <div class="text-sm text-wrap ml-2" style="max-width: 350px">
                                                                {{$alert->volume}}
                                                                {{$alert->payment_system}}
                                                                {{$alert->type_name}}
                                                                {{$alert->add_info}}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            {!!$alert->icon !!}
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <span class="d-block text-center text-sm pb-2 mt-1 text-green">
                                            @lang('buttons.see-all')
                                        </span>
                                    </a>
                                </div>
                            </li>
                        @endif
                        <li class="nav-item dropdown ml-2">
                            <a class="nav-link" role="button" data-toggle="dropdown" aria-haspopup="true">
                                <b>Refferal link</b>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-left py-0 overflow-hidden"
                                onclick="copyToClipboard(this)" style="cursor: pointer; ">
                                <!-- List group -->
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item list-group-item-action b-ref-popup">
                                        <div class="b-ref-popup__text"><i
                                                class="b-ref-popup__icon ni ni-single-copy-04"></i> <span
                                                class="b-ref-popup__hint">@lang('base.dash.menu.ref_hint')</span></div>
                                        <pre class="b-ref-popup__link mb-0 text-sm">{{ $referral_link }}</pre>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function copyToClipboard(elem) {
                                    const el = document.createElement('textarea');
                                    el.value = '{{ $referral_link }}';
                                    el.setAttribute('readonly', '');
                                    el.style.position = 'absolute';
                                    el.style.left = '-9999px';
                                    document.body.appendChild(el);
                                    el.select();
                                    document.execCommand('copy');
                                    document.body.removeChild(el);

                                    // уведомление про успешное копирование
                                    $.notify({ // options
                                        icon: 'ni ni-check-bold',
                                        message: "@lang('base.dash.menu.ref_notify')"
                                    }, { // settings
                                        offset: {
                                            x: 30,
                                            y: 15
                                        },
                                        type: 'success',
                                        allow_dismiss: false,
                                        delay: 800,
                                        animate: {
                                            enter: "animated fadeInUp",
                                            exit: "animated fadeOutDown"
                                        }
                                    });
                                };

                            </script>
                        </li>
                        <!-- <li class="mobile-user-level nav-item">
                            <a href="{{route('home.referrals')}}" href="javascript:" class="nav-link">
                                @lang('auth.level') <b>{{ Auth()->user()->bonus_level }}</b><br>
                                (@lang('auth.achieved_level') <b>{{ Auth()->user()->achieved_bonus_level }}</b>)
                            </a>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-4 mt--1">
                        <li class="nav-item dropdown">
                            <a class="nav-link p-0" href="{{route('home.balance')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="nav-link p-0">
                                <div class="media align-items-center">
                                    <div class="media-body d-none d-lg-block">
                                        <span class="mb-0 text-sm font-weight-bold">{{ Auth::user()->balance_usd }} USDT</span>
                                    </div>
                                    <span class="avatar avatar-sm rounded-circle">
                                        <i class="ni ni-money-coins"></i>
                                    </span>
                                </div>
                            </div>
                            </a>
                            {{-- <div class="dropdown-menu dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Balances</h6>
                                </div>
                                <a href="{{ route('home.profile.profile') }}" class="dropdown-item text-muted">
                                    <i class="ni ni-money-coins"></i>
                                    <span>{{ Auth::user()->balance_btc }} BTC</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item text-muted">
                                    <i class="ni ni-money-coins"></i>
                                    <span>{{ Auth::user()->balance_eth }} ETH</span>
                                </a>
                                <span class="d-block text-center text-sm pb-2 mt-1 text-green">
                                    <a href="{{ route('home.balance') }}">Top up and withdraw</a>
                                </span>
                            </div> --}}
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center ml-4 mt--1">
                        <li class="nav-item dropdown">
                            <a class="nav-link p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="media align-items-center">

                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ $user->name }}</span>
                                    </div>
                                    <span class="avatar avatar-sm rounded-circle">
                                        <i class="ni ni-circle-08"></i>
                                    </span>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">@lang('base.dash.menu.welcome')</h6>
                                </div>
                                <a href="{{ route('home.profile.profile') }}" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>@lang('base.dash.menu.pr_settings')</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>@lang('base.dash.menu.logout')</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Alerts -->
        @if (session('flash_success'))
            <div class="alert alert-message-notification alert-success in alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                {{ session('flash_success') }}
            </div>
        @endif
        <!-- End  Alerts -->
        <!-- Header -->
        @yield('content')
        <!-- Footer -->
        <footer class="footer bg-transparent pt-0 mt-0">
            <div class="d-flex align-items-center justify-content-lg-between mx-3">
                <div class="text-white">
                    &copy; {{Carbon\Carbon::now()->year}} <a href="/" class="ml-1 text-white">Monexo</a>
                </div>
            </div>
        </footer>
    </div>
    <script>
        function urlChangeGetParam(key, value) {
            var queryParams = new URLSearchParams(window.location.search);
            if (value) {
                queryParams.set(key, value);
            } else {
                queryParams.delete(key);
            }
            history.pushState(null, null, '?' + queryParams.toString());
        }

        function paydir() {
            urlChangeGetParam('tab', 'withdraw');
            document.querySelector('.payin').style.display = "none";
            document.querySelector('.payout').style.display = "block";
        }

        function paydir2() {
            urlChangeGetParam('tab', null);
            document.querySelector('.payout').style.display = "none";
            document.querySelector('.payin').style.display = "block";
        }

    </script>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('script/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('script/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('script/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('script/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('script/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('script/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('script/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->
    <script src="{{ asset('script/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('script/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('script/dashboard/argon.js?v=1.2.0.0511') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/js/jquery.treegrid.min.js"></script>
    <script>
        $(function() {
            $('.table-tree').treegrid({
                initialState: 'collapsed'
            });
        });

        let user_id = "{{Auth::user()->id}}";
    </script>

    <script src="{{asset('js\app\alerts.js')}}"></script>




    @yield('js')
</body>

</html>
