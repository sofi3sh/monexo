<section id="products" class="bizes page__bizes">
    <div class="bizes-header">
        <div class="container bizes__container">
            <h2 class="title bizes__title" data-aos="fade-up">@lang('dinway.main.bizes.title')</h2>
            <div class="bizes-text bizes__text" data-aos="fade-up">
                <p class="bizes-text__item">@lang('dinway.main.bizes.text.1')</p>
            </div>
        </div>
    </div>
    <div class="bizes__content">
        <div class="container bizes__container">
            <div class="bizes__blocks">
               <div class="biz" data-aos="flip-up" data-aos="flip-down">
                    <div class="biz-img">
                        <img width="320" height="240" class="lazyload" data-src="{{asset('img/frontsite/bizes/main/bizes-1.png')}}" alt>
                    </div>
                    <h3 class="biz__title">@lang('dinway.main.bizes.investments')</h3>
                    <p class="biz__subtitle">@lang('dinway.main.bizes.investments-descr')</p>
                    <a class="biz__link btn-transparent" href="{{route('website.dinway-investments')}}">
                        @lang('dinway.main.bizes.detail')<span>></span>
                    </a>
                </div>
               <div class="biz" data-aos="flip-up" data-aos="flip-down">
                    <div class="biz-img">
                        <img width="320" height="240" class="lazyload" data-src="{{asset('img/frontsite/bizes/blogtime/bizes-4.png')}}" alt>
                    </div>
                    <h3 class="biz__title">@lang('dinway.main.bizes.education.title')</h3>
                    <p class="biz__subtitle">@lang('dinway.main.bizes.education.subtitle')</p>
                    <a class="biz__link btn-transparent" href="{{route('website.dinway-affiliate-program')}}">
                        @lang('dinway.main.bizes.detail')<span>></span>
                    </a>
                </div>
               <div class="biz" data-aos="flip-up" data-aos="flip-down">
                    <div class="biz-img">
                        <img width="320" height="240" class="lazyload" data-src="{{asset('img/frontsite/bizes/main/bizes-3.png')}}" alt>
                    </div>
                    <h3 class="biz__title">@lang('dinway.main.bizes.game')</h3>
                    <p class="biz__subtitle">@lang('dinway.main.bizes.game-descr')</p>
                    <a class="biz__link btn-transparent" href="{{route('website.dinway-businessgaming')}}">
                        @lang('dinway.main.bizes.detail')<span>></span>
                    </a>
                </div>
               <div class="biz" data-aos="flip-up" data-aos="flip-down">
                    <div class="biz-img">
                        <img width="320" height="240" class="lazyload" data-src="{{asset('img/frontsite/bizes/main/bizes-4.png')}}" alt>
                    </div>
                    <h3 class="biz__title">@lang('dinway.main.bizes.blogtime')</h3>
                    <p class="biz__subtitle">@lang('dinway.main.bizes.blogtime-descr')</p>
                    <a class="biz__link btn-transparent" href="{{route('website.dinway-blogtime')}}">
                        @lang('dinway.main.bizes.detail')<span>></span>
                    </a>
                </div>
               <div class="biz" data-aos="flip-up" data-aos="flip-down">
                    <div class="biz-img">
                            <img width="320" height="240" class="lazyload" data-src="{{asset('img/frontsite/bizes/main/bizes-5.png')}}" alt>
                        </picture>
                    </div>
                    <h3 class="biz__title">@lang('dinway.main.bizes.businesspack')</h3>
                    <p class="biz__subtitle">@lang('dinway.main.bizes.businesspack-descr')</p>
                    <a class="biz__link btn-transparent" href="{{route('website.dinway-businesspack')}}">
                        @lang('dinway.main.bizes.detail')<span>></span>
                    </a>
                </div>
            </div>
            <div class="bizes-offer">
                <h3 class="title bizes-offer__title" data-aos="zoom-in">@lang('dinway.main.bizes.consultation')</h3>
                <p class="bizes-offer__subtitle" data-aos="zoom-in">@lang('dinway.main.bizes.consultation-descr')</p>
                {{-- <button class="btn-white biz__btn" data-aos="zoom-in"  data-micromodal-trigger="modal-feedback">@lang('dinway.main.bizes.consultation-button')</button> --}}
                <a
                   href="#tickets"
                   class="btn-white biz__btn" data-aos="zoom-in" >@lang('dinway.main.bizes.consultation-button')</a>
                <img class="bizes-offer__flower" class="lazyload" data-src="{{asset('img/frontsite/bizes/flower.svg')}}" alt aria-hidden="true">
            </div>
        </div>
    </div>
    <img class="bizes__decor" src="{{asset('img/frontsite/decor-branch-1.svg')}}" alt aria-hidden="true">
    <img height="200" class="bizes__wave2" src="{{asset('img/frontsite/bizes/bizes-wave-2.svg')}}" alt aria-hidden="true">
</section>
