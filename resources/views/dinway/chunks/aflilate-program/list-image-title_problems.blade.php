@php
    $problems = [
        '1' => [
            'icon' => 'list-image-title_problem_icon1',
            'text' => 'list1'
        ],
        '2' => [
            'icon' => 'list-image-title_problem_icon2',
            'text' => 'list2'
        ],
        '3' => [
            'icon' => 'list-image-title_problem_icon3',
            'text' => 'list3'
        ],
        '4' => [
            'icon' => 'users',
            'text' => 'list4'
        ],
        '5' => [
            'icon' => 'business',
            'text' => 'list5'
        ],
        '6' => [
            'icon' => 'list-image-title_problem_icon4',
            'text' => 'list6'
        ],
        '7' => [
            'icon' => 'blog',
            'text' => 'list7'
        ],
        '8' => [
            'icon' => 'list-image-title_help_icon3',
            'text' => 'list8'
        ]
    ]
@endphp

<section class="list-image-title list-image-title_problem section">
    <div class="container list-image-title__container">
        <h2 class="title list-image-title__title" data-aos="fade-up">@lang('dinway.aflilate-program.list-image-title_problems.title')</h2>
        <ul class="list-image-title-ul">
            @foreach ($problems as $problem)
                <li class="list-image-title-ul__item" data-aos="fade-up">
                    <svg fill="#EBF1FE" width="50" height="40">
                        <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#{{$problem['icon']}}"></use>
                    </svg>
                    <p class="list-image-title-ul__text">
                        @lang('dinway.aflilate-program.list-image-title_problems.'. $problem['text'])
                    </p>
                </li>
            @endforeach
        </ul>
        <div class="list-image-title__image" data-aos="fade-up">
            <picture>
                <source srcset="{{asset('img/frontsite/list-image-title/affilate-problem.webp')}}" type="image/webp">
                <img src="{{asset('img/frontsite/list-image-title/affilate-problem.png')}}" alt="">
            </picture>
        </div>
    </div>
</section>
