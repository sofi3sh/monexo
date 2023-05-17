<section id="curses" class="section bizes bizes_bg page__bizes">
    <div class="bizes-header">
        <div class="container bizes__container">
            <h2 class="title bizes__title">@lang('dinway.education.bizes.title')</h2>
        </div>
    </div>
    <div class="bizes__content">
        <div class="container bizes__container">
            <div class="bizes__blocks bizes__blocks--education">
                <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/education/bizes-1.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/education/bizes-1.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.education.bizes.card-1-title')</h3>
                    <p class="biz__subtitle">@lang('dinway.education.bizes.card-1-descr')</p>
                    <a
                        type="button"
                        class="biz__link btn-transparent" 
                        @guest
                            href="{{route('login')}}"
                        @else
                            href="{{route('home.profi-universe')}}"
                        @endguest 
                    >
                        @lang('dinway.education.bizes.detail')
                    </a>
                </div>
                <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/education/bizes-2.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/education/bizes-2.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.education.bizes.mlm')</h3>
                    <p class="biz__subtitle">@lang('dinway.education.bizes.mlm-descr')</p>
                    <button type="button" class="biz__link btn-transparent" disabled>
                        @lang('dinway.btns.dev')
                    </button>
                </div>
                <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/education/bizes-3.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/education/bizes-3.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.education.bizes.messenger')</h3>
                    <p class="biz__subtitle">@lang('dinway.education.bizes.messenger-descr')</p>
                    <button type="button" class="biz__link btn-transparent" disabled>
                        @lang('dinway.btns.dev')
                    </button>
                </div>
               <div class="biz" data-aos="flip-up" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/education/bizes-4.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/education/bizes-4.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.education.bizes.web')</h3>
                    <p class="biz__subtitle">@lang('dinway.education.bizes.web-descr')</p>
                    <button type="button" class="biz__link btn-transparent" disabled>
                        @lang('dinway.btns.dev')
                    </button>
                </div>
            </div>
            @include('dinway.chunks.investments.simple-slider')
            <div class="bizes-offer">
                <h3 class="title bizes-offer__title" data-aos="zoom-in">@lang('dinway.education.bizes.offer')</h3>
                <p class="bizes-offer__subtitle" data-aos="zoom-in">@lang('dinway.education.bizes.offer-descr')</p>
                <a
                   href="#tickets"
                   class="btn-white biz__btn" data-aos="zoom-in"
                >
                   @lang('dinway.education.bizes.offer-button')
                </a>
                {{-- <button class="btn-white biz__btn" data-aos="zoom-in"  data-micromodal-trigger="modal-feedback">@lang('dinway.education.bizes.offer-button')</button> --}}
                <img class="bizes-offer__flower" src="{{asset('img/frontsite/bizes/flower.svg')}}" alt aria-hidden="true">
            </div>
        </div>
    </div>
    
    <img class="bizes__decor" src="{{asset('img/frontsite/decor-branch-1.svg')}}" alt aria-hidden="true">
    <img height="200" class="bizes__wave2" src="{{asset('img/frontsite/bizes/bizes-wave-2.svg')}}" alt aria-hidden="true">
</section>
