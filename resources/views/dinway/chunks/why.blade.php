<section id="why" class="section why page__why">
    <div class="container why__container">
        <h2 class="title why__title" data-aos="fade-up">@lang('dinway.why.title')</h2>
        <div class="why-text why__text" data-aos="fade-up">
            <p class="why-text__item">
                @lang('dinway.why.text.1')
            </p>
        </div>
        <div class="why-blocks why__blocks" data-aos="fade-up">
            <div class="advantage">
                <div class="advantage__img advantage__img--1">
                    <picture>
                        <source srcset="{{asset('img/frontsite/why/why-1.webp')}}" type="image/webp">
                        <img width="260" height="200" src="{{asset('img/frontsite/why/why-1.png')}}" alt="Удобство">
                    </picture>
                </div>
                <h3 class="advantage__title">@lang('dinway.why.advantage1_title')</h3>
                <p class="advantage__subtitle">@lang('dinway.why.advantage1_subtitle')</p>
            </div>
            <div class="advantage">
                <div class="advantage__img advantage__img--2">
                    <img width="209" height="177" class="lazyload" data-srcset="{{asset('img/frontsite/why/why-2.webp')}}" data-src="{{asset('img/frontsite/why/why-2.png')}}" alt="Открытость">
                </div>
                <h3 class="advantage__title">@lang('dinway.why.advantage2_title')</h3>
                <p class="advantage__subtitle">@lang('dinway.why.advantage2_subtitle')</p>
            </div>
            <div class="advantage">
                <div class="advantage__img advantage__img--3">
                    <img width="260" height="200" class="lazyload" data-src="{{asset('img/frontsite/why/why-3.png')}}" alt="Социальность">
                </div>
                <h3 class="advantage__title">@lang('dinway.why.advantage3_title')</h3>
                <p class="advantage__subtitle">@lang('dinway.why.advantage3_subtitle')</p>
            </div>
            <div class="advantage">
                <div class="advantage__img advantage__img--4">
                    <img width="260" height="200" class="lazyload" src="{{asset('img/frontsite/why/why-4.png')}}" alt="Стабильность">
                </div>
                <h3 class="advantage__title">@lang('dinway.why.advantage4_title')</h3>
                <p class="advantage__subtitle">@lang('dinway.why.advantage4_subtitle')</p>
            </div>
        </div>
    </div>
</section>
