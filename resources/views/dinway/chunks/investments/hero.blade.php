<div class="hero hero_ap page__hero">
    <a href="/blog/post/mlmup-20-pozitsioniruy-sebya-pravilno" class="hero__banner" data-aos="fade-left">
        MLM UP 2.0 →
    </a>
    <div class="container hero__container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <h1 class="hero-title hero__title">@lang('dinway.investments.hero.title')</h1>
                <p class="hero-subtitle hero__subtitle">@lang('dinway.investments.hero.descr')</p>
            </div>
            <div class="hero-img" data-aos="fade-left">
                <picture>
                    <source srcset="{{asset('img/frontsite/hero/investments/hero-img.webp')}}" type="image/webp">
                    <img class="hero-img__img" src="{{asset('img/frontsite/hero/investments/hero-img.png')}}" alt aria-hidden="true">
                </picture>
            </div>
            <div class="hero-btns" data-aos="fade-right">
                <a
                    @guest
                        href="{{route('login')}}"
                    @else
                        href="{{route('home.marketing-plans.index')}}"
                    @endguest
                   class="btn-blue hero-btn"
                >@lang('dinway.investments.hero.button')</a>
            </div>
        </div>
    </div>
</div>
