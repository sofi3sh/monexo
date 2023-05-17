<section class="section news page__news">
    <div class="container news__container">
        <h2 class="title news__title">@lang('dinway.news.title')</h2>
        <div class="swipe-info">
            <span class="swipe-info__text">@lang('dinway.news.title')</span>
            <span class="swipe-info__arrow">
                <img class="swipe-info__img" src="{{asset('img/frontsite/swipe-info-arrow.svg')}}" alt="->">
            </span>
        </div>
        <div class="news-slider">
            <svg class="news-slider__prev" width="9" height="13" viewBox="0 0 9 13" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.39247 5.0931C0.62112 5.87244 0.62112 7.12756 1.39247 7.90691L5.57851 12.1363C6.83543 13.4063 9 12.5162 9 10.7294L9 2.27058C9 0.483798 6.83543 -0.406268 5.57851 0.863675L1.39247 5.0931Z" fill="inherit"/>
            </svg>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide">
                            <div class="blog-card hover shadow" data-aos="fade-up">
                                <div class="blog-card__image">
                                    <img data-src="{{ $post->image }}" class="@if($loop->index > 2) swiper-lazy @else lazyload @endif" />
                                    @if($loop->index > 2)
                                        <div class="swiper-lazy-preloader"></div>
                                    @endif
                                </div>
                                <div class="blog-card__text">
                                    <div class="blog-card__info">
                                        <time class="blog-card__date" datetime="{{ $post->published_at }}">
                                            {{ $post->formatted_published_at }}
                                        </time>
                                        <p class="blog-card__author text-limit">{{ $post->author->name }}</p>
                                    </div>
                                    <div class="blog-card__content">
                                        <h2 class="blog-card__title text-limit" style="color: {{ $post->color }};">{{ $post->title }}</h2>
                                        <p class="blog-card__desc">{!!  $post->excerpt !!}</p>
                                    </div>
                                    <div class="blog-card__footer">
                                        <a href="{{ route('blog.post.show', $post->slug) }}" class="blog-card__link cover">
                                            @lang('dinway.btns.more')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <svg class="news-slider__next" width="9" height="13" viewBox="0 0 9 13" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.60753 5.0931C8.37888 5.87244 8.37888 7.12756 7.60753 7.90691L3.42149 12.1363C2.16457 13.4063 2.29692e-06 12.5162 2.04843e-06 10.7294L8.72056e-07 2.27058C6.23566e-07 0.483798 2.16457 -0.406268 3.42149 0.863675L7.60753 5.0931Z"/>
            </svg>
        </div>
        <a href="{{route('website.dinway-blog')}}" class="btn-blue news__btn">@lang('dinway.btns.go-to-news')</a>
    </div>
</section>
