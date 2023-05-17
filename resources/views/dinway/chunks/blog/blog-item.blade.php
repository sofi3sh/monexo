<section class="blog-slider">
    <div class="container blog-slider__container">
        <div class="blog-item">
            <div class="blog-card blog-card--lg">
                <div class="blog-card__image">
                    <img width="750" height="393" src="{{ $post->image }}" alt="Post image">
                </div>
                <div class="blog-card__text">
                    <div class="blog-card__content">
                        <h2 class="blog-card__title" style="color: {{ $post->category->color }};">{{ $post->name }}</h2>
                        @if($post->tags_string)
                            <div class="blog-card__tags">{{ $post->tags_string }}</div>
                        @endif
                        <p class="blog-card__desc">{!! nl2br(preg_replace('"\b(https?://\S+)"', '<a style="color: #1448B6" href="$1">$1 </a>', $post->content)) !!}</p>
                        <div class="blog-card-info">
                            <div class="blog-card-info__left">
                                <p class="blog-card-info__author">@lang('Author'): <strong>{{ $post->author->name }}</strong></p>
                                <p class="blog-card-info__category">
                                    @lang('Category'):
                                    <a href="{{ route('blog.post.index', ['category' => $post->category->slug]) }}">
                                        {{$post->category->name }}
                                    </a>
                                </p>
                                <p class="blog-card-info__date">@lang('Date'): <strong>{{ $post->formatted_published_at }}</strong></p>
                            </div>
                            <div class="blog-card-info__right">
                                <span>@lang('Views'): <strong>{{ $post->views }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card__footer">
                        <a href="
                        @if(isset($lk))
                            {{ route('home.blog.post.index') }}
                        @else
                            {{ route('blog.post.index') }} 
                        @endif
                        "
                        class="blog-card__link">
                            <svg class="arrow-icon blog-card-text-footer__icon">
                                <use xlink:href="/img/frontsite/svg/sprite.svg#arrow-left"></use>
                            </svg>
                            @lang('Back')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@isset($post->meta)
    @section('description', $post->meta->description)
    @section('keywords', $post->meta->keywords)
@endisset
