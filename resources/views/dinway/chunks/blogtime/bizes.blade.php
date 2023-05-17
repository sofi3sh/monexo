<section class="section bizes section">
    <div class="bizes-header">
        <div class="container bizes__container">
            <h2 class="title text-center">@lang('dinway.blogtime.bizes.services')</h2>
        </div>
    </div>
    <div class="bizes__content">
        <div class="container bizes__container">
            <div class="bizes__blocks bizes__blocks--blogtime">
               <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/blogtime/bizes-1.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/blogtime/bizes-1.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.blogtime.bizes.consultation')</h3>
                    <p class="biz__subtitle">@lang('dinway.blogtime.bizes.consultation-descr')</p>
                    <a href="#tickets" class="biz__link btn-transparent">
                        @lang('dinway.blogtime.bizes.details') <span>></span>
                    </a>
                </div>
               <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/blogtime/bizes-2.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/blogtime/bizes-2.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.blogtime.bizes.photosession')</h3>
                    <p class="biz__subtitle">@lang('dinway.blogtime.bizes.photosession-descr')</p>
                    <a href="#tickets" class="biz__link btn-transparent">
                        @lang('dinway.blogtime.bizes.details') <span>></span>
                    </a>
                </div>
               <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/blogtime/bizes-3.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/blogtime/bizes-3.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.blogtime.bizes.chat-bots')</h3>
                    <p class="biz__subtitle">@lang('dinway.blogtime.bizes.chat-bots-descr')</p>
                    <a href="#tickets" class="biz__link btn-transparent">
                        @lang('dinway.blogtime.bizes.details') <span>></span>
                    </a>
                </div>
               <div class="biz" data-aos="flip-up" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/blogtime/bizes-4.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/blogtime/bizes-4.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.blogtime.bizes.landing-page')</h3>
                    <p class="biz__subtitle">@lang('dinway.blogtime.bizes.landing-page-descr')</p>
                    <a href="#tickets" class="biz__link btn-transparent">
                        @lang('dinway.blogtime.bizes.details') <span>></span>
                    </a>
                </div>
            </div>
            @include('dinway.chunks.investments.simple-slider')
            <div class="bizes-offer">
                <h3 class="title bizes-offer__title" data-aos="zoom-in">@lang('dinway.blogtime.bizes.started')</h3>
                <p class="bizes-offer__subtitle" data-aos="zoom-in">@lang('dinway.blogtime.bizes.started-descr')</p>
                <a
                   href="#tickets"
                   class="btn-white biz__btn" data-aos="zoom-in" >@lang('dinway.blogtime.bizes.sign-up')</a>
               {{-- <button class="btn-white biz__btn" data-aos="zoom-in"  data-micromodal-trigger="modal-feedback">@lang('dinway.blogtime.bizes.sign-up')</button> --}}
                <img class="bizes-offer__flower" src="{{asset('img/frontsite/bizes/flower.svg')}}" alt aria-hidden="true">
            </div>
        </div>
    </div>
    <img class="bizes__decor" src="{{asset('img/frontsite/decor-branch-1.svg')}}" alt aria-hidden="true">
    <img height="200" class="bizes__wave2" src="{{asset('img/frontsite/bizes/bizes-wave-2.svg')}}" alt aria-hidden="true">
</section>
