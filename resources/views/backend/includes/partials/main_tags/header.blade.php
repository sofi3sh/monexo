<header id="header">
    <div class="top_menu">
        <div class="control_panel">
            {{-- Панель управления и навигации --}}
            <div class="panel_bar">

                {{-- Вернуться на сайт --}}
                <div class="exit">
                    <a href="{{ route('website.home') }}" target="_blank">
                        <span>
                            @include('backend.includes.partials.svg.exit')
                        </span>
                        <strong>@lang('cabinet_nav.top_menu.return')</strong>
                    </a>
                </div>

                {{-- Поддержка --}}
                <div class="support">
                    <a href="https://telegram.me/Agio_Support" target="_blank">
                        @include('backend.includes.partials.svg.support')
                    </a>
                </div>

                {{-- Окно помощи --}}
                <div class="help_window">
                    <button type="button">
                        @include('backend.includes.partials.svg.help')
                    </button>
                </div>

                {{-- Выбор языка --}}
                @include('includes.partials.cabinet_langs')

                {{-- Меню пользователя --}}
                <div class="user_account">
                    <div class="header" onClick="">
                        <div class="logo">
                            <img src="{{ asset('/backend/production/img/icons/user.png') }}" alt="Multi Wallet">
                        </div>
                        @if (Auth::user()->name == '')
                            <span>@lang('cabinet_nav.top_menu.control')</span>
                        @else
                            <span>{{ Auth::user()->name }}</span>
                        @endif
                        <small class="arrow">
                            @include('backend.includes.partials.svg.user_arrow')
                        </small>
                    </div>
                    <div class="menu">
                        <a href="{{ route('home.profile.profile') }}" class="line">
                            <div class="logo">
                                @include('backend.includes.partials.svg.page_profile')
                            </div>
                            <span>@lang('cabinet_nav.top_menu.settings')</span>
                        </a>
                        <a href="{{ route('logout') }}" class="line">
                            <div class="logo">
                                @include('backend.includes.partials.svg.user_logout')
                            </div>
                            <span>@lang('cabinet_nav.top_menu.logout')</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <nav class="left_menu">
        <div class="nav_wrapper">
            <div class="logo">
                <img src="{{ asset('/backend/production/img/logo/logo_inv_1.png') }}" alt="Agio">
                <img src="{{ asset('/backend/production/img/logo/logo_inv_2.png') }}" alt="Agio" class="ending">
            </div>
            <a href="{{ route('home.main') }}" class="{{ isActive('home.main', 'active') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.page_home')
                </div>
                <span class="text">@lang('cabinet_nav.left_menu.home')</span>
            </a>
            <a href="{{ route('home.invest') }}" class="{{ isActive('home.invest', 'active') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.page_finance')
                </div>
                <span class="text">@lang('cabinet_nav.left_menu.invest')</span>
            </a>
            <a href="{{ route('home.marketing-plans.index') }}" class="{{ isActive('home.marketing-plans.index', 'active') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.page_plans')
                </div>
                <span class="text">@lang('cabinet_nav.left_menu.plans')</span>
            </a>
            <a href="{{ route('home.referrals') }}" class="{{ isActive('home.referrals', 'active') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.page_referrals')
                </div>
                <span class="text">@lang('cabinet_nav.left_menu.refer')</span>
            </a>
            <a href="{{ route('home.withdrawal.create') }}" class="{{ isActive('home.withdrawal.create', 'active') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.page_withdrawal')
                </div>
                <span class="text">@lang('cabinet_nav.left_menu.withd')</span>
            </a>
            <a href="{{ route('home.transactions') }}" class="{{ isActive('home.transactions', 'active') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.page_transactions')
                </div>
                <span class="text">@lang('cabinet_nav.left_menu.history')</span>
            </a>
            <a href="{{ route('home.profile.profile') }}" class="{{ isActive('home.profile.profile', 'active') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.page_profile')
                </div>
                <span class="text">@lang('cabinet_nav.top_menu.settings')</span>
            </a>
            <a href="{{ route('logout') }}">
                <div class="icon">
                    @include('backend.includes.partials.svg.user_logout')
                </div>
                <span class="text">@lang('cabinet_nav.top_menu.logout')</span>
            </a>
        </div>
    </nav>
    <div class="control left_menu_control">
        <button class="menu_btn">
            <span></span>
        </button>
    </div>
    <div class="control top_menu_control">
        <button class="menu_btn">
            <span></span>
        </button>
    </div>
</header>