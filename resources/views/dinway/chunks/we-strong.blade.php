{{-- Together we strong --}}
<section>
    <div class="container">
        <h2 class="title text-center mb-3" data-aos="fade-up">@lang('dinway.we-strong.title')</h2>
        @for ($i = 1; $i <= 3; $i++)
            <div class="image-text image-text--img5-txt7 @if($i & 1) reverse @endif">
                <div class="image-text__image" @if($i & 1) data-aos="fade-left" @else data-aos="fade-right" @endif>
                    <img class="lazyload" data-src="{{asset('img/frontsite/we-strong/'. $i .'.png')}}" alt>
                </div>
                <div class="image-text__text" @if($i & 1) data-aos="fade-right" @else data-aos="fade-left" @endif>
                    @lang('dinway.we-strong.' . $page . '.text.' . $i)
                </div>
            </div>    
        @endfor
    </div>
</section>