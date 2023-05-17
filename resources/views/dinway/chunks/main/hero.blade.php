<div class="hero hero_main">
    <a href="/blog/post/mlmup-20-pozitsioniruy-sebya-pravilno" class="hero__banner" data-aos="fade-left">
        MLM UP 2.0 →
    </a>
    <div class="container hero__container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <div class="hero-text__info btn-green">@lang('dinway.main.hero.title')</div>
                <h1 class="hero-title hero__title">@lang('dinway.main.hero.subtitle')</h1>
                <p class="hero-subtitle hero__subtitle">@lang('dinway.main.hero.descr')</p>
            </div>
            <div class="hero-img hero-img" data-aos="fade-left">
                <picture>
                    <source srcset="{{asset('img/frontsite/hero/main/hero-img.webp')}}">
                    <img width="660" height="459" class="hero-img__img" src="{{asset('img/frontsite/hero/main/hero-img.png')}}" alt="Main picture" >
                </picture>
                {{-- <button aria-label="Запустить видео" id="hero-video-btn" class="hero-img__youtube">
                    <svg width="50" height="36" viewBox="0 0 50 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M47.875 4.125C46.5187 1.7125 45.0469 1.26875 42.05 1.1C39.0563 0.896875 31.5281 0.8125 25.0063 0.8125C18.4719 0.8125 10.9406 0.896875 7.95 1.09688C4.95937 1.26875 3.48438 1.70937 2.11562 4.125C0.71875 6.53437 0 10.6844 0 17.9906C0 17.9969 0 18 0 18C0 18.0063 0 18.0094 0 18.0094V18.0156C0 25.2906 0.71875 29.4719 2.11562 31.8563C3.48438 34.2687 4.95625 34.7062 7.94688 34.9094C10.9406 35.0844 18.4719 35.1875 25.0063 35.1875C31.5281 35.1875 39.0562 35.0844 42.0531 34.9125C45.05 34.7094 46.5219 34.2719 47.8781 31.8594C49.2875 29.475 50 25.2937 50 18.0187C50 18.0187 50 18.0094 50 18.0031C50 18.0031 50 17.9969 50 17.9937C50 10.6844 49.2875 6.53437 47.875 4.125Z" fill="#F44336"/>
                        <path d="M18.75 27.375V8.625L34.375 18L18.75 27.375Z" fill="#FAFAFA"/>
                    </svg>
                </button> --}}
            </div>
            <div class="hero-btns" data-aos="fade-right" data-aos="fade-right">
                <a href="#products" class="btn-blue hero-btn">
                    @lang('dinway.main.hero.product')
                </a>
                <button class="hero-btn btn-transparent" data-micromodal-trigger="modal-strategy">
                    @lang('dinway.strategy.title')
                </button>
            </div>
        </div>
        <div id="company-indicators" class="company-indicators" data-aos="fade-top" data-aos-duration="1000">
            <div class="company-indicator">
                <div class="company-indicator__icon">
                    <svg class="indicator-icon">
                         <use xlink:href="{{asset('img/frontsite/svg/sprite.svg#customer')}}"></use>
                    </svg>
                </div>
                <div class="company-indicator__text">
                    <h2 id="indicator" class="company-indicator__title" data-count="3000">3000</h2>
                    <p class="company-indicator__subtitle">@lang('dinway.main.hero.indicators.customers')</p>
                </div>
            </div>
            <div class="company-indicator">
                <div class="company-indicator__icon">
                    <svg class="indicator-icon">
                        <use xlink:href="{{asset('img/frontsite/svg/sprite.svg#investments')}}"></use>
                    </svg>
                </div>
                <div class="company-indicator__text">
                    <h2 class="company-indicator__title"><span id="indicator" data-count="5">5</span> млн</h2>
                    <p class="company-indicator__subtitle">@lang('dinway.main.hero.indicators.investments')</p>
                </div>
            </div>
            <div class="company-indicator">
                <div class="company-indicator__icon">
                    <svg class="indicator-icon">
                         <use xlink:href="{{asset('img/frontsite/svg/sprite.svg#product')}}"></use>
                    </svg>
                </div>
                <div class="company-indicator__text">
                    <h2 id="indicator" class="company-indicator__title" data-count="6">6</h2>
                    <p class="company-indicator__subtitle">@lang('dinway.main.hero.indicators.products')</p>
                </div>
            </div>
            <div class="company-indicator">
                <div class="company-indicator__icon">
                    <svg class="indicator-icon">
                        <use xlink:href="{{asset('img/frontsite/svg/sprite.svg#users')}}"></use>
                    </svg>
                </div>
                <div class="company-indicator__text">
                    <h2 id="indicator" class="company-indicator__title" data-count="7000">7000</h2>
                    <p class="company-indicator__subtitle">@lang('dinway.main.hero.indicators.users')</p>
                </div>
            </div>
        </div>
    </div>
</div>
