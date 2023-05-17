<div class="container  mb-3">
    <div class="invest-conditions">

        <div class="invest-condition invest-condition--1" data-aos="flip-down" data-aos-duration="700">
            
            <div class="invest-condition-top">
                <h3 class="invest-condition-top__title">
                    LIGHT
                </h3>
                <strong class="invest-condition-top__text-percent">
                    5.5-13.7%
                </strong>
                <p class="invest-condition-top__text-time">
                    @lang('dinway.invest-conditions.light.time')
                </p>
                <p class="invest-condition-top__text-profit">
                    @lang('dinway.invest-conditions.light.profit')
                </p>
            </div>

            <div class="invest-condition-bottom">
                <h3 class="invest-condition-bottom__title">
                    @lang('dinway.invest-conditions.light.period')
                </h3>
                <ul class="invest-condition-bottom-list">
                    <li class="invest-condition-bottom-list__item">
                        <svg fill="#3F78F3" width="14" height="9">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#check"></use>
                        </svg>
                        <span class="invest-condition-bottom-list__text">
                            @lang('dinway.invest-conditions.light.list.1')
                        </span>
                    </li>
                    <li class="invest-condition-bottom-list__item">
                        <svg fill="#3F78F3" width="14" height="9">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#check"></use>
                        </svg>
                        <span class="invest-condition-bottom-list__text">
                            @lang('dinway.invest-conditions.light.list.2')
                        </span>
                    </li>
                    <li class="invest-condition-bottom-list__item">
                        <svg fill="#F5672F" width="14" height="11">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#cross"></use>
                        </svg>
                        <span class="invest-condition-bottom-list__text">
                            @lang('dinway.invest-conditions.light.list.3')
                        </span>
                    </li>
                </ul>
                <div class="invest-condition-bottom__period">
                    $1 000 - $100 000
                </div>
                <a
                    class="invest-condition-bottom__btn btn-white"
                    @guest
                        href="{{route('login')}}"
                    @else
                        href="{{route('home.marketing-plans.index', ['plan' => 'Light'])}}"
                    @endguest
                   class="btn-blue"
                >@lang('buttons.invest')</a>
            </div>
        </div>

        <div class="invest-condition invest-condition--3" data-aos="flip-down" data-aos-duration="700">
            <div class="invest-condition-top">
                <h3 class="invest-condition-top__title">
                    MINI
                </h3>
                <strong class="invest-condition-top__text-percent">
                    12.3-24%
                </strong>
                <p class="invest-condition-top__text-time">
                    @lang('dinway.invest-conditions.mini.time')
                </p>
                <p class="invest-condition-top__text-profit">
                    @lang('dinway.invest-conditions.mini.profit')
                </p>
            </div>
            <div class="invest-condition-bottom">
                <h3 class="invest-condition-bottom__title">
                    @lang('dinway.invest-conditions.mini.period')
                </h3>
                <ul class="invest-condition-bottom-list">
                    <li class="invest-condition-bottom-list__item">
                        <svg fill="#F5672F" width="14" height="11">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#cross"></use>
                        </svg>
                        <span class="invest-condition-bottom-list__text">
                            @lang('dinway.invest-conditions.mini.list.1')
                        </span>
                    </li>
                    <li class="invest-condition-bottom-list__item">
                        <svg fill="#3F78F3" width="14" height="9">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#check"></use>
                        </svg>
                        <span class="invest-condition-bottom-list__text">
                            @lang('dinway.invest-conditions.mini.list.2')
                        </span>
                    </li>
                    <li class="invest-condition-bottom-list__item">
                        <svg fill="#3F78F3" width="14" height="9">
                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#check"></use>
                        </svg>
                        <span class="invest-condition-bottom-list__text">
                            @lang('dinway.invest-conditions.mini.list.3')
                        </span>
                    </li>
                </ul>
                <div class="invest-condition-bottom__period">
                    $100 - $2 000
                </div>
                <a
                    class="invest-condition-bottom__btn btn-white"
                    @guest
                        href="{{route('login')}}"
                    @else
                        href="{{route('home.marketing-plans.index', ['plan' => 'Mini'])}}"
                    @endguest
                   class="btn-blue"
                >@lang('buttons.invest')</a>
            </div>
        </div>
    </div>
</div>
