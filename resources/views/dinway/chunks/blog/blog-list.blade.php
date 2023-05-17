<section class="blog-slider">
    <div class="blog-slider__top">
        <ul class="blog-slider-menu">
            <li class="blog-slider-menu__item @empty($selectedCategory) active @endif" data-item>
                <a href="
                @if(isset($lk))
                    {{ route('home.blog.post.index') }}
                @else
                    {{ route('blog.post.index') }}
                @endif
                "
                class="blog-slider-menu__btn">
                    @lang('dinway.blog.categories.all')
                </a>
            </li>
            @foreach($categories as $category)
                <li class="blog-slider-menu__item @if($selectedCategory && $selectedCategory->slug === $category->slug) active @endif" data-item>
                    <a href="
                    @if(isset($lk))
                        {{ route('home.blog.post.index', ['category' => $category->slug]) }} 
                    @else 
                        {{ route('blog.post.index', ['category' => $category->slug]) }}
                    @endif
                    "
                    class="blog-slider-menu__btn">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="container blog-slider__container">
        <div class="blog-cards">
            @foreach($posts as $post)
                <div class="blog-card hover" data-aos="fade-up">
                    <div class="blog-card__image">
                        <img width="340" height="240" src="{{ $post->image }}" alt="Post image">
                    </div>
                    <div class="blog-card__text">
                        <div class="blog-card__info">
                            <time class="blog-card__date" datetime="{{ $post->formatted_published_at }}">
                                {{ $post->formatted_published_at }}
                            </time>
                            <p class="blog-card__author text-limit">{{ $post->author->name }}</p>
                        </div>
                        <div class="blog-card__content">
                            <h2 class="blog-card__title text-limit" style="color: {{ $post->category->color }};">{{ $post->name }}</h2>
                            <p class="blog-card__desc">{!! $post->excerpt !!}</p>
                        </div>
                        <div class="blog-card__footer">
                            <a href="
                                @if(isset($lk))
                                    {{ route('home.blog.post.show', $post->slug) }} 
                                @else 
                                    {{ route('blog.post.show', $post->slug) }} 
                                @endif
                            "
                            class="blog-card__link cover"> {{-- cover --}}
                                @lang('dinway.btns.more')
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @php
            $nextUrl = '#';

            if(isset($lk)) {
                $nextUrl = route('blog.post.index', ['page' => 2]);
            } else {
                $nextUrl = route('home.blog.post.index', ['page' => 2]);
            }
        @endphp
        <a href="{{$nextUrl}}" class="pagination__next d-none"></a>
    </div>
</section>
