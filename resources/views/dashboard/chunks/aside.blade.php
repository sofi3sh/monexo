@php
    $alerts_count = $alerts_count > 0 ? $alerts_count : '';
    $navbarItemsUp = [
        '1' => [
            'text' => 'base.dash.menu.tosite',
            'icon' => 'ni ni-bold-left',
            'href' => 'website.home'
        ],
        '2' => [
            'text' => 'base.dash.menu.home',
            'icon' => 'ni ni-chart-bar-32',
            'href' => 'home.main'
        ],
        '3' => [
            'text' => 'base.dash.menu.balance',
            'icon' => 'ni ni-money-coins',
            'href' => 'home.balance',
            'extra-text' => "$$balance"
            // 'primary' => 'primary-item'
        ],
        '4' => [
            'text' => 'base.dash.menu.balance-more',
            'icon' => 'ni ni-planet',
            'href' => 'home.debts-info',
            'condition' => Auth::user()->is_verif
        ],
        '5' => [
            'text' => 'base.dash.menu.alerts',
            'icon' => 'ni ni-notification-70',
            'icon-number' => $alerts_count,
            'href' => 'home.alerts',
        ]
    ];

    $sections = [
        'products' => [
            'title' => 'base.dash.menu.products.title',
            'items' => [
                '1' => [
                    'text' => 'base.dash.menu.products.items.investments',
                    'href' => 'home.marketing-plans.index',
                    'icon' => 'ni ni-briefcase-24',
                ],
                '2' => [
                    'text' => 'base.dash.menu.career.items.referral',
                    'href' => 'home.referrals',
                    'icon' => 'ni ni-chart-pie-35'
                ],
                /*'3' => [
                    'text' => 'base.dash.menu.products.items.profi_uinverse',
                    'href' => 'home.services.profi_universe',
                    'icon' => 'fas fa-graduation-cap'
                ],
                '4' => [
                    'text' => 'base.dash.menu.products.items.businessgaming.title',
                    'href' => 'game.graybull.index',
                    'icon' => 'fas fa-gamepad'
                ],*/
                '3' => [
                    'text' => 'base.dash.menu.faq',
                    'href' => 'home.ticket',
                    'icon' => 'fas fa-question-circle'
                ]
            ],
        ],
    ];

@endphp

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light rounded m-3 bg-white">
    <div class="scrollbar-inner">
        <div class="navbar-inner">
            <div class="collapse navbar-collapse mr-3" id="sidenav-collapse-main">
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark cross" data-action="sidenav-pin"
                    data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner mr-3">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.93359 6.38672L2.37695 0.829346L0.763672 2.44238L6.32227 8L0.763672 13.5574L2.37695 15.1704L7.93555 9.61304L13.4922 15.1704L15.1055 13.5574L9.54688 8L15.1055 2.44263L13.4922 0.829346L7.93359 6.38672Z"
                                fill="#5E72E4" />
                        </svg>
                    </div>
                </div>
                <ul class="navbar-nav">
                    @foreach ($navbarItemsUp as $item)
                        @if($item['condition'] ?? true)
                            <li class="nav-item @isset($item['unclick']) unclick @endisset
                                @isset($item['primary'])
                                    {{$item['primary']}}
                                @endisset
                            ">
                                <a class="nav-link" style="position: relative" href="{{ route($item['href']) }}">
                                    <i class="{{$item['icon']}}" style="color: #6425fe !important"></i>
                                    @isset($item['icon-number'])
                                        <span id="alerts-count"
                                            class='bg-gradient-warning alerts-count ml-1 text-white'
                                            style="position: absolute; top: 10px; left: 4px; font-size: 0.5rem; padding: 0px 5px; border-radius: 5px; margin-top: -4px; vertical-align: middle;"
                                        >
                                        {!!  $item['icon-number']!!}
                                        </span>
                                    @endisset
                                    @isset($item['extra-text'])
                                    <span class="nav-link-text text-dark font-weight-normal">{!! __($item['text']) . ' ' . $item['extra-text']!!}</span>

                                    @else
                                        <span class="nav-link-text text-dark font-weight-normal">@lang($item['text'])</span>
                                    @endisset
                                </a>
                            </li>
                        @endif
                        
                    @endforeach
                </ul>
                @foreach ($sections  as $section)
                    <hr class="my-3 p-0">
                    <ul class="navbar-nav">
                        <!-- {{route('home.blog.post.index')}} -->
                        @foreach ($section['items'] as $item)
                            <li class="nav-item
                                @isset($item['unclick'])
                                    unclick
                                @endisset

                                @isset($item['primary'])
                                    {{$item['primary']}}
                                @endisset
                                ">
                                @if(isset($item['inner']))
                                    <span class="nav-link">
                                        <i class="{{$item['icon']}}" style="color: #6425fe !important"></i>
                                        <span class="nav-link-text">@lang($item['text'])</span>
                                    </span>
                                @else
                                    <a class="nav-link" href="{{ route($item['href']) }}" style="position: relative">
                                        <i class="{{$item['icon']}}" style="color: #6425fe !important"></i>
                                        @isset($item['icon-number'])
                                            <span id="{{$item['icon-number']['id']}}"
                                                          class='bg-warning alerts-count ml-1 text-white'
                                                          style="position: absolute; top: 10px; left: 4px; font-size: 0.5rem; padding: 0px 5px; border-radius: 5px; margin-top: -4px; vertical-align: middle"
                                                    >
                                                {!!  $item['icon-number']['text']!!}
                                            </span>
                                        @endisset
                                        <span class="nav-link-text">@lang($item['text'])</span>
                                    </a>
                                @endif
                            </li>
                            @isset($item['inner'])
                                <ul style="list-style: none">
                                    @foreach ($item['inner'] as $itemInner)
                                        <li class="d-flex align-items-center py-2 @isset($itemInner['unclick']) unclick @endisset">
                                            <i class="{{$itemInner['icon']}} mr-2" style="font-size: 6px; color: #6425fe !important"></i>
                                            <a class="text-dark"  href="{{route($itemInner['href'])}}">@lang($itemInner['text'])</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endisset
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
</nav>
