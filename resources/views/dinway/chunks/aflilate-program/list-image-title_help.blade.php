@php
    $helps = [
        '1' => [
            'icon' => 'list-image-title_help_icon1',
            'text' => 'list1'
        ],
        '2' => [
            'icon' => 'list-image-title_help_icon2',
            'text' => 'list2'
        ],
        '3' => [
            'icon' => 'list-image-title_help_icon3',
            'text' => 'list3'
        ],
        '4' => [
            'icon' => 'list-image-title_help_icon4',
            'text' => 'list4'
        ],
        '5' => [
            'icon' => 'tool',
            'text' => 'list5'
        ]
    ]
@endphp

<section class="list-image-title list-image-title_help section reverse">
    <div class="container list-image-title__container">
        <h2 class="title list-image-title__title" data-aos="fade-up">@lang('dinway.aflilate-program.list-image-title_help.title')</h2>
        <ul class="list-image-title-ul">
            @foreach ($helps as $help)
                <li class="list-image-title-ul__item" data-aos="fade-up">
                    <svg fill="#EBF1FE" width="50" height="40"><use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#{{$help['icon']}}"></use></svg>
                    <p class="list-image-title-ul__text">
                        @lang('dinway.aflilate-program.list-image-title_help.' . $help['text'])
                    </p>
                </li> 
            @endforeach
        </ul>
        <div class="list-image-title__image" data-aos="fade-up-right">
            <picture>
                <source srcset="{{asset('img/frontsite/list-image-title/affilate-help.webp')}}" type="image/webp">
                <img src="{{asset('img/frontsite/list-image-title/affilate-help.png')}}" alt="">
            </picture>
        </div>
    </div>
</section>
