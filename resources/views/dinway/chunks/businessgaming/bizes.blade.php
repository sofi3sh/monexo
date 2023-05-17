<section id="games" class="section bizes bizes_bg page__bizes">
    <div class="bizes-header">
        <div class="container bizes__container">
            <h2 class="title text-center" data-aos="fade-up">@lang('dinway.businessgaming.bizes.title')</h2>
        </div>
    </div>
    <div class="bizes__content">
        <div class="container bizes__container">
            <div class="bizes__blocks bizes__blocks--businessgaming">
                 <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/business-gaming/bizes-1.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/business-gaming/bizes-1.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.businessgaming.bizes.graybull')</h3>
                    <p class="biz__subtitle">@lang('dinway.businessgaming.bizes.graybull-descr')</p>
                    <button class="biz__link btn-transparent" data-micromodal-trigger="modal-bizes-graybull">
                        @lang('dinway.businessgaming.bizes.detail')<span>></span>
                    </button>
                </div>
                <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/business-gaming/bizes-2.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/business-gaming/bizes-2.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.businessgaming.bizes.tote')</h3>
                    <p class="biz__subtitle">@lang('dinway.businessgaming.bizes.tote-descr')</p>
                    <button class="biz__link btn-transparent" data-micromodal-trigger="modal-development">
                        @lang('dinway.businessgaming.bizes.detail')<span>></span>
                    </button>
                </div>
                <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/business-gaming/bizes-3.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/business-gaming/bizes-3.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.businessgaming.bizes.chess')</h3>
                    <p class="biz__subtitle">@lang('dinway.businessgaming.bizes.chess-descr')</p>
                    <button class="biz__link btn-transparent" data-micromodal-trigger="modal-development">
                        @lang('dinway.businessgaming.bizes.detail')<span>></span>
                    </button>
                </div>
               <div class="biz" data-aos="flip-up">
                    <div class="biz-img">
                        <picture>
                            <source srcset="{{asset('img/frontsite/bizes/business-gaming/bizes-4.webp')}}" type="image/webp">
                            <img src="{{asset('img/frontsite/bizes/business-gaming/bizes-4.png')}}" alt="">
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.businessgaming.bizes.creative')</h3>
                    <p class="biz__subtitle">@lang('dinway.businessgaming.bizes.creative-descr')</p>
                    <button class="biz__link btn-transparent" data-micromodal-trigger="modal-development">
                        @lang('dinway.businessgaming.bizes.detail')<span>></span>
                    </button>
                </div>
            </div>
            @include('dinway.chunks.investments.simple-slider')
            <div class="bizes-offer">
                <h3 class="title bizes-offer__title" data-aos="zoom-in">@lang('dinway.businessgaming.bizes.offer-title')</h3>
                <p class="bizes-offer__subtitle" data-aos="zoom-in">@lang('dinway.businessgaming.bizes.offer-descr')</p>
                <a
                   href="#tickets"
                   class="btn-white biz__btn" data-aos="zoom-in"
                >
                   @lang('dinway.businessgaming.bizes.sign-up')
                </a>
               {{-- <button class="btn-white biz__btn" data-aos="zoom-in"  data-micromodal-trigger="modal-feedback">@lang('dinway.businessgaming.bizes.sign-up')</button> --}}
                <img class="bizes-offer__flower" src="{{asset('img/frontsite/bizes/flower.svg')}}" alt aria-hidden="true">
            </div>
        </div>
    </div>
    <img class="bizes__decor" src="{{asset('img/frontsite/decor-branch-1.svg')}}" alt aria-hidden="true">
    <img class="bizes__wave2" src="{{asset('img/frontsite/bizes/bizes-wave-2.svg')}}" alt aria-hidden="true">
</section>
