<footer id="container_about" class="footer">
    <svg class="footer__wave" viewBox="0 0 1357 48" fill="red" xmlns="http://www.w3.org/2000/svg">
        <path height="200px" d="M371.5 23.0001C250.3 19.8001 74 37.6668 1 47.0001H1356.5V1.00032C1312.17 0.666982 1217.8 0.200315 1195 1.00032C1172.2 1.80032 999.167 20.0003 915.5 29.0003C778.5 48.5003 523 27.0001 371.5 23.0001Z" stroke="none"/>
    </svg> 
    <div class="footer__body">
        <div class="container footer__container">
            <div class="footer-text" data-aos="zoom-in-up">
                <div class="footer-menu">
                    <h2 class="footer__title">@lang('dinway.footer.menu')</h2>
                    <div class="footer-menu__lists">
                        <ul class="footer-menu-list">
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#home"></use>
                                </svg>
                                <a href="{{route('website.home')}}">@lang('dinway.products-list.main')</a> 
                            </li> 
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#faq"></use>
                                </svg>
                                <a href="{{route('website.dinway-faq')}}">@lang('dinway.products-list.faq')</a> 
                            </li> 
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#partners"></use>
                                </svg>
                                <a href="{{route('website.dinway-affiliate-program')}}">@lang('dinway.products-list.affiliate')</a>
                            </li> 
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#login"></use>
                                </svg>
                                <a 
                                    href="@if (Auth::check()) {{ url('home') }} @else {{route('login')}} @endif"
                                >
                                    @lang('dinway.cabinet.login')
                                </a>
                            </li> 
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#signup"></use>
                                </svg>
                                <a 
                                    href="@if (Auth::check()) {{ url('home') }} @else {{route('register')}} @endif"
                                >
                                    @lang('dinway.cabinet.signup')
                                </a>
                            </li>
                        </ul>
                        <ul class="footer-menu-list">
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#investments"></use>
                                </svg>
                                <a href="{{route('website.dinway-investments')}}">@lang('dinway.products-list.investments')</a>
                            </li>
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#gaming"></use>
                                </svg>
                                <a href="{{route('website.dinway-businessgaming')}}">@lang('dinway.products-list.gaming')</a>
                            </li>
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#blogtime"></use>
                                </svg>
                                <a href="{{route('website.dinway-blogtime')}}">@lang('dinway.products-list.blogtime')</a>
                            </li>
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#business"></use>
                                </svg>
                                <a href="{{route('website.dinway-businesspack')}}">@lang('dinway.products-list.businesspack')</a>
                            </li>
                            <li class="footer-menu-list__item">
                                <svg class="footer-icon footer-menu__icon">
                                    <use xlink:href="/img/frontsite/svg/sprite.svg#universe"></use>
                                </svg>
                                <a href="{{route('website.dinway-education')}}">@lang('dinway.products-list.education')</a> 
                            </li>
                        </ul>
                    </div>
                </div>
                <h2 class="footer__title">@lang('dinway.footer.contact')</h2>
                <div class="social footer__social">
                    <a aria-label="Перейти в instagram Dinway" href="https://www.instagram.com/dinwaycommunity" target="_blank">
                        <svg class="social__insta social__icon icon_white">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#insta"></use>
                        </svg>
                    </a>
                    {{-- <a href="#" target="_blank">
                        <svg class="social__whatsapp social__icon icon_white">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#whatsapp"></use>
                        </svg>
                    </a> --}}
                    <a aria-label="Перейти в telegram Dinway" href="https://t.me/dinwaycommunity" target="_blank">
                        <svg class="social__telegram social__icon icon_white">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#telegram"></use>
                        </svg>
                    </a>
                    <a aria-label="Перейти на youtube Dinway" href="https://www.youtube.com/c/DinwayCommunity" target="_blank">
                        <svg class="social__youtube social__icon icon_white">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#youtube"></use>
                        </svg>
                    </a>
                    <a aria-label="Перейти на facebook Dinway" href="https://www.facebook.com/groups/dinwaycommunity" target="_blank">
                        <svg class="social__fb social__icon icon_white">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#fb"></use>
                        </svg>
                    </a>
                    <a aria-label="Перейти в vk Dinway" href="https://vk.com/dinwaycommunity" target="_blank">
                        <svg class="social__vk social__icon icon_white">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#vk"></use>
                        </svg>
                    </a>
                </div>
                <p class="footer__desc">
                    @lang('dinway.footer.copyright')
                    <a href="{{route('website.dinway-agreement')}}">@lang('dinway.footer.use')</a>
                </p>
            </div>
            <div class="footer-img" data-aos="zoom-in-up">
                <img class="footer-img__image" src="{{asset('img/frontsite/footer/footer-img.svg')}}" alt="@lang('dinway.footer.alt-img')">
            </div>
        </div>
    </div>
</footer>
