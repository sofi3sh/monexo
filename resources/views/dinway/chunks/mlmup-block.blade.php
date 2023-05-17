<div class="section">
    <h2 class="title text-center mb-3" data-aos="fade-up">@lang('dinway.mlmup-block.title')</h2>
    <div class="container overflow-hidden d-flex justify-center mb-3">
        <picture>
            @foreach(config('locale.languages') as $lang)
                @if($lang[0] == app()->getLocale() && $lang[4])
                    {{-- <source srcset="{{asset('/img/frontsite/mlmup/mlmup-block-' . $lang[0] . '.webp')}}" type="image/webp"> --}}
                    <img width="767" 
                         height="369" 
                         class="lazyload"
                         data-src="{{asset('img/frontsite/mlmup/mlmup-block-' . $lang[0] . '.png')}}" 
                         alt="IT MLM INVEST"
                         data-aos="flip-up">
                @endif
            @endforeach
            
        </picture>
    </div>
</div>