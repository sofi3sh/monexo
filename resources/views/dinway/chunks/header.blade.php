<header class="header">
    <div class="container header__container">
        <div class="header__left">
            <a href="{{ route('website.home') }}" class="logo header__logo">
                <img width="45" height="60"  src="{{asset('img/frontsite/logo.svg')}}" alt="logo">
            </a>
            <p class="header__slogan">
                @lang('dinway.header.slogan')
            </p>
            <ul class="header-list">
                <li class="header-list__item">
                    <a href="{{route('website.home')}}">
                        @lang('dinway.products-list.main')
                    </a>
                </li>
                <li class="header-list__item">
                    <a href="{{ route('blog.post.index') }}">
                        @lang('dinway.products-list.blog')
                    </a>
                </li>
                <li class="header-list__item">
                    <a href="#container_about">
                        @lang('dinway.products-list.contacts')
                    </a>
                </li>
                <li class="header-list__item">
                    <a href="{{route('website.dinway-faq')}}">
                        @lang('dinway.products-list.faq')
                    </a>
                </li>
                <li class="header-list__item">
                    <a href="{{route('website.dinway-events')}}">
                        @lang('dinway.products-list.events')
                    </a>
                </li>
                <li class="header-list__item">
                    <a href="{{route('website.regulations')}}">
                        @lang('dinway.products-list.regulations')
                    </a>
                </li>
            </ul>
        </div>
        <div class="header__right">
            <div class="lang header__lang">
                <span class="link-language--active">
                    @lang('dinway.header.lang1')
                </span>
                /
                @foreach (config('locale.languages') as $lang)
                    @if ($lang[0] != app()->getLocale() && $lang[4])
                            <a class="link-language" href="{{'/lang/'.$lang[0]}}">{{strtoupper($lang[0])}}</a>
                    @endif
                @endforeach
            </div>
            <a class="consultation header__consultation" href="#tickets">
                @lang('dinway.header.consultation')
            </a>
            <div class="auth header__auth">
                @if($userName === '0')
                    <a class="auth__login"
                    href="@if (Auth::check()) {{ url('home') }} @else {{route('login')}} @endif"
                    >
                    @lang('dinway.cabinet.login')
                    </a>
                    /
                    <a class="auth__signup"
                    href="@if (Auth::check()) {{ url('home') }} @else {{route('register')}} @endif"
                    >
                        @lang('dinway.cabinet.signup')
                        {{-- @lang('dinway.header.entry') --}}
                    </a>
                @else
                    <span class="auth__username">
                        {{$userName}}
                    </span>
                    <a class="auth__login"
                        href="@if (Auth::check()) {{ url('home') }} @else {{route('login')}} @endif"
                    >
                        @lang('dinway.cabinet.login')
                    </a>
                @endif
            </div>
        </div>
        <div class="burger header__burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="products-menu">
        <div class="products-menu__container">
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-list__item nav-list__item--md">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#home"></use>
                        </svg>
                        <a href="{{route('website.home')}}">
                            @lang('dinway.products-list.main')
                        </a>
                    </li>
                    <li class="nav-list__item">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#investments"></use>
                        </svg>
                        <a href="{{route('website.dinway-investments')}}">
                            @lang('dinway.products-list.investments')
                        </a>
                    </li>
                    <li class="nav-list__item">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#partners"></use>
                        </svg>
                        <a href="{{route('website.dinway-affiliate-program')}}">
                            @lang('dinway.products-list.affiliate')
                        </a>
                    </li>
                    <li class="nav-list__item">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#gaming"></use>
                        </svg>
                        <a href="{{route('website.dinway-businessgaming')}}">
                            @lang('dinway.products-list.gaming')
                        </a>
                    </li>
                    <li class="nav-list__item">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#blogtime"></use>
                        </svg>
                        <a href="{{route('website.dinway-blogtime')}}">
                            @lang('dinway.products-list.blogtime')
                        </a>
                    </li>
                    <li class="nav-list__item">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#business"></use>
                        </svg>
                        <a href="{{route('website.dinway-businesspack')}}">
                            @lang('dinway.products-list.businesspack')
                        </a>
                    </li>
                    <li class="nav-list__item">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#universe"></use>
                        </svg>
                        <a href="{{route('website.dinway-education')}}">
                            @lang('dinway.products-list.education')
                        </a>
                    </li>
                    <li class="nav-list__item nav-list__item--md">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#blog"></use>
                        </svg>
                        <a href="{{ route('blog.post.index') }}">
                            @lang('dinway.products-list.blog')
                        </a>
                    </li>
                    <li class="nav-list__item nav-list__item--md">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#contacts"></use>
                        </svg>
                        <a href="#container_about">
                            @lang('dinway.products-list.contacts')
                        </a>
                    </li>
                    <li class="nav-list__item nav-list__item--md">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#event"></use>
                        </svg>
                        <a href="{{route('website.dinway-events')}}">
                            @lang('dinway.products-list.events')
                        </a>
                    </li>
                    <li class="nav-list__item nav-list__item--md">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#regulations"></use>
                        </svg>
                        <a href="{{route('website.regulations')}}">
                            @lang('dinway.products-list.regulations')
                        </a>
                    </li>
                    <li class="nav-list__item nav-list__item--md nav-list__item--products-end">
                        <svg class="header-icon nav-list__icon">
                            <use xlink:href="/img/frontsite/svg/sprite.svg#faq"></use>
                        </svg>
                        <a href="{{route('website.dinway-faq')}}">
                            @lang('dinway.products-list.faq')
                        </a>
                    </li>
                    
                    <li class="nav-list__item nav-list__item--md">
                        <div class="auth">
                            <a class="auth__login"
                            href="@if (Auth::check()) {{ url('home') }} @else {{route('login')}} @endif"
                            >
                            @lang('dinway.cabinet.login')
                            </a>
                            /
                            <a class="auth__signup"
                            href="@if (Auth::check()) {{ url('home') }} @else {{route('register')}} @endif"
                            >
                                @lang('dinway.cabinet.signup')
                                {{-- @lang('dinway.header.entry') --}}
                            </a>
                        </div>
                    </li>
                    <li class="nav-list__item nav-list__item--md">
                        <div class="lang">
                            <span class="link-language--active">
                                @lang('dinway.header.lang1')
                            </span>
                            /
                            @foreach (config('locale.languages') as $lang)
                                @if ($lang[0] != app()->getLocale() && $lang[4])
                                    <a class="link-language" href="{{'/lang/'.$lang[0]}}">{{strtoupper($lang[0])}}</a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    {{-- <li class="nav-list__item nav-list__item--md">
                        <a class="consultation" href="#tickets">
                            @lang('dinway.header.consultation')
                        </a>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
</header>
