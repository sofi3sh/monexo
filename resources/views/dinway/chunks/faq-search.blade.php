<section class="faq-search">
    <div class="container faq-search__container">
        <div class="faq-search__content">
            <div class="faq-search__left">
                <picture>
                    <source srcset="{{asset('img/frontsite/faq-search/faq-search-img.webp')}}" type="image/webp">
                    <img class="faq-search__image" src="{{asset('img/frontsite/faq-search/faq-search-img.png')}}" alt="@lang('dinway.faq-search.alt_search')">
                </picture>
            </div>
            <div class="faq-search__right">
                <h2 class="faq-search__title">@lang('dinway.faq-search.title')</h2>
                <div class="faq-search__search search">
                    <input class="search__input" type="text" placeholder="@lang('dinway.faq-search.search')">
                    <svg class="search__loupe">
                        <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#search"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
