@extends('dashboard.app')

@section('content')

    @php
        $moduleZeroVideos = [
            1 => '422016104',
            2 => '422550888',
            3 => '422024030',
        ];

        $moduleOneVideos = [
            1 =>  '421869722',
            2 =>  '421884209',
            3 =>  '421892977',
            4 =>  '421864230',
            5 =>  '421854557',
            6 =>  '421830930',
            7 =>  '422506589',
            8 =>  '421845530',
            9 =>  '421918365',
            10 => '421815817',
            11 => '421926002',
            12 => '421936206',
            13 => '421820364',
            14 => '421902981',
            15 => '421821987',
        ];

        $moduleTwoVideos = [
            1 =>  '421813958',
            2 =>  '421908468',
            3 =>  '421809341',
            4 =>  '421807835',
            5 =>  '449252268',
            6 =>  '422056976',
            7 =>  '421634113',
        ];

        $moduleThreeVideos = [
            1 =>  '421590236',
            2 =>  '421510191',
            3 =>  '421491331',
            4 =>  '421470665',
            5 =>  '421460523',
            6 =>  '421458876',
            7 =>  '421823552',
            8 =>  '421457727',
            9 =>  '421457127',
            10 => '421325191',
            11 => '421323369',
            12 => '421322352',
            13 => '421322059',
            14 => '421321339',
            15 => '421320778',
            16 => '421817249',
            17 => '421320429',
        ];

        $moduleFourVideos = [
            1 =>  '421319437',
            2 =>  '421318107',
            3 =>  '421316439',
            4 =>  '421313080',
            5 =>  '421311601',
            6 =>  '426106478',
            7 =>  '421310957',
        ];

        $moduleFiveVideos = [
            1 =>  '444815827',
            2 =>  '421308774',
            3 =>  '421341175',
            4 =>  '422038609',
            5 =>  '421303137',
            6 =>  '421302069',
            7 =>  '421300412',
            8 =>  '421298875',
            9 =>  '421293988',
            10 => '421288802',
        ];
    @endphp

    <div class="container-fluid">
        <h1 class="h1 mt-3 text-center mb-0">@lang('base.dash.profi-universe.mlm_up_2_dot_0.title')</h1>
        <section class="py-4 text-center">
            <h2 class="text-left mb-2">@lang('base.dash.profi-universe.mlm_up_2_dot_0.module-0.title')</h2>
            <div class="profi-universe-slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @for ($i = 1; $i <= count($moduleZeroVideos); $i++)
                            @php
                                $video = $moduleZeroVideos[$i];
                            @endphp
                            <div class="swiper-slide">
                                <div class="embed-responsive embed-responsive-16by9 rounded">
                                    <iframe class="lazy embed-responsive-item"
                                            data-src="https://player.vimeo.com/video/{{$video}}"
                                            frameborder="0"
                                            webkitallowfullscreen
                                            mozallowfullscreen
                                            allowfullscreen
                                            allow="autoplay; encrypted-media">
                                    </iframe>
                                </div>
                                <h3 class="h3 mt-2">
                                    @lang('base.dash.profi-universe.mlm_up_2_dot_0.module-0.lesson' . $i)
                                </h3>
                            </div>
                        @endfor
                    </div>
                    <button class="swiper-button-prev bg-transparent border-0"></button>
                    <button class="swiper-button-next bg-transparent border-0"></button>
                </div>
            </div>
        </section>

        @if($paid == 0)
            <div class="mb-3" id="course">
                <span id="title" hidden>MLM UP 2.0</span>
                <span id="single" hidden>video_courses</span>
                <p>@lang('base.dash.profi-universe.for_next_view') $<span id="price">90</span></p>
                <button id="main_btn" type="button" data-toggle="modal" data-target="#modal_order" class="btn btn-primary mb-2">
                    @lang('dinway.blogtime.instruction.to-order')
                </button>
            </div>
        @endif

        @if($paid != 0)
            @if ($showVideo[1] === 1)
            <section class="py-4 text-center">
                <h2 class="h2 text-left mb-2">@lang('base.dash.profi-universe.mlm_up_2_dot_0.module-1.title')</h2>
                <div class="profi-universe-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @for ($i = 1; $i <= count($moduleOneVideos); $i++)
                                @php
                                    $video = $moduleOneVideos[$i];
                                @endphp
                                <div class="swiper-slide">
                                    <div class="embed-responsive embed-responsive-16by9 rounded">
                                        <iframe class="lazy embed-responsive-item"
                                                data-src="https://player.vimeo.com/video/{{$video}}"
                                                frameborder="0"
                                                webkitallowfullscreen
                                                mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media">
                                        </iframe>
                                    </div>
                                    <h3 class="h3 mt-2">
                                        @lang('base.dash.profi-universe.mlm_up_2_dot_0.module-1.lesson' . $i)
                                    </h3>
                                </div>
                            @endfor
                        </div>
                        <button class="swiper-button-prev bg-transparent border-0"></button>
                        <button class="swiper-button-next bg-transparent border-0"></button>
                    </div>
                </div>
                @if ($showButton[1] === 1)
                    <button id="btn-homework" class="btn btn-primary" data-toggle="modal" data-module="1" data-target="#modalHomeWork">@lang('base.dash.btns.exam')</button>
                @endif
            </section>
            @endif

            @if ($showVideo[2] === 1)
            <section class="py-4 text-center">
                <h2 class="h2 text-left mb-2">@lang('base.dash.profi-universe.mlm_up_2_dot_0.module-2.title')</h2>
                <div class="profi-universe-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @for ($i = 1; $i <= count($moduleTwoVideos); $i++)
                                @php
                                    $video = $moduleTwoVideos[$i];
                                @endphp
                                <div class="swiper-slide">
                                    <div class="embed-responsive embed-responsive-16by9 rounded">
                                        <iframe class="lazy embed-responsive-item"
                                                data-src="https://player.vimeo.com/video/{{$video}}"
                                                frameborder="0"
                                                webkitallowfullscreen
                                                mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media">
                                        </iframe>
                                    </div>
                                    <h3 class="h3 mt-2">
                                        @lang('base.dash.profi-universe.mlm_up_2_dot_0.module-2.lesson' . $i)
                                    </h3>
                                </div>
                            @endfor
                        </div>
                        <button class="swiper-button-prev bg-transparent border-0"></button>
                        <button class="swiper-button-next bg-transparent border-0"></button>
                    </div>
                </div>
                @if ($showButton[2] === 1)
                    <button id="btn-homework" class="btn btn-primary" data-toggle="modal" data-module="2" data-target="#modalHomeWork">@lang('base.dash.btns.exam')</button>
                @endif
            </section>
            @endif

            @if ($showVideo[3] === 1)
            <section class="py-4 text-center">
                <h2 class="h2 text-left mb-2">@lang('base.dash.profi-universe.mlm_up_2_dot_0.module-3.title')</h2>
                <div class="profi-universe-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @for ($i = 1; $i <= count($moduleThreeVideos); $i++)
                                @php
                                    $video = $moduleThreeVideos[$i];
                                @endphp
                                <div class="swiper-slide">
                                    <div class="embed-responsive embed-responsive-16by9 rounded">
                                        <iframe class="lazy embed-responsive-item"
                                                data-src="https://player.vimeo.com/video/{{$video}}"
                                                frameborder="0"
                                                webkitallowfullscreen
                                                mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media">
                                        </iframe>
                                    </div>
                                    <h3 class="h3 mt-2">
                                        @lang('base.dash.profi-universe.mlm_up_2_dot_0.module-3.lesson' . $i)
                                    </h3>
                                </div>
                            @endfor
                        </div>
                        <button class="swiper-button-prev bg-transparent border-0"></button>
                        <button class="swiper-button-next bg-transparent border-0"></button>
                    </div>
                </div>
                @if ($showButton[3] === 1)
                    <button id="btn-homework" class="btn btn-primary" data-toggle="modal" data-module="3" data-target="#modalHomeWork">@lang('base.dash.btns.exam')</button>
                @endif
            </section>
            @endif

            @if ($showVideo[4] === 1)
            <section class="py-4 text-center">
                <h2 class="h2 text-left mb-2">@lang('base.dash.profi-universe.mlm_up_2_dot_0.module-4.title')</h2>
                <div class="profi-universe-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @for ($i = 1; $i <= count($moduleFourVideos); $i++)
                                @php
                                    $video = $moduleFourVideos[$i];
                                @endphp
                                <div class="swiper-slide">
                                    <div class="embed-responsive embed-responsive-16by9 rounded">
                                        <iframe class="lazy embed-responsive-item"
                                                data-src="https://player.vimeo.com/video/{{$video}}"
                                                frameborder="0"
                                                webkitallowfullscreen
                                                mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media">
                                        </iframe>
                                    </div>
                                    <h3 class="h3 mt-2">
                                        @lang('base.dash.profi-universe.mlm_up_2_dot_0.module-4.lesson' . $i)
                                    </h3>
                                </div>
                            @endfor
                        </div>
                        <button class="swiper-button-prev bg-transparent border-0"></button>
                        <button class="swiper-button-next bg-transparent border-0"></button>
                    </div>
                </div>
                @if ($showButton[4] === 1)
                    <button id="btn-homework" class="btn btn-primary" data-toggle="modal" data-module="4" data-target="#modalHomeWork">@lang('base.dash.btns.exam')</button>
                @endif
            </section>
            @endif

            @if ($showVideo[5] === 1)
            <section class="py-4 text-center">
                <h2 class="h2 text-left mb-2">@lang('base.dash.profi-universe.mlm_up_2_dot_0.module-5.title')</h2>
                <div class="profi-universe-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @for ($i = 1; $i <= count($moduleFiveVideos); $i++)
                                @php
                                    $video = $moduleFiveVideos[$i];
                                @endphp
                                <div class="swiper-slide">
                                    <div class="embed-responsive embed-responsive-16by9 rounded">
                                        <iframe class="lazy embed-responsive-item"
                                                data-src="https://player.vimeo.com/video/{{$video}}"
                                                frameborder="0"
                                                webkitallowfullscreen
                                                mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media">
                                        </iframe>
                                    </div>
                                    <h3 class="h3 mt-2">
                                        @lang('base.dash.profi-universe.mlm_up_2_dot_0.module-5.lesson' . $i)
                                    </h3>
                                </div>
                            @endfor
                        </div>
                        <button class="swiper-button-prev bg-transparent border-0"></button>
                        <button class="swiper-button-next bg-transparent border-0"></button>
                    </div>
                </div>
                @if ($showButton[5] === 1)
                    <button id="btn-homework" class="btn btn-primary" data-toggle="modal" data-module="5" data-target="#modalHomeWork">@lang('base.dash.btns.exam')</button>
                @endif
            </section>
            @endif
        @endif
    </div>


    <div class="modal fade" id="modalHomeWork" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-lg"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-content" class="modal-body">
                    <form class="modal-form" method="post" action="{{ route('home.profi-universe.store') }}">
                        @csrf
                        <div class="modal-form-content"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.services.chunks.modal-order')

@endsection

@section('js')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    {{-- <script src="{{asset('js\lazysizes.min.js')}}"></script> --}}
    <script defer>
        let profiUniverseSlider = new Swiper('.profi-universe-slider .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                560: {
                    slidesPerView: 2,

                },
                900: {
                    slidesPerView: 3,
                }
            }
        });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        if ("IntersectionObserver" in window) {
            var iframes = document.querySelectorAll("iframe.lazy");
            var iframeObserver = new IntersectionObserver(function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting && entry.target.src.length == 0) {
                        entry.target.src = entry.target.dataset.src;
                        iframeObserver.unobserve(entry.target);
                    }
                });
            });

            iframes.forEach(function (iframe) {
                iframeObserver.observe(iframe);
            });
        } else {
            var iframes = document.querySelector('iframe.lazy');

            for (var i = 0; i < iframes.length; i++) {
                if (lazyVids[i].getAttribute('data-src')) {
                    lazyVids[i].setAttribute('src', lazyVids[i].getAttribute('data-src'));
                }
            }
        }
    })
</script>

    <script src="{{asset('js/profi-universe/homework.js')}}"></script>
    <script src="{{asset('js/services/services.js')}}"></script>
@endsection




