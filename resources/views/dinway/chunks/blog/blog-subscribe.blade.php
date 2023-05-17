<section class="section news-subscription">
    <div class="container news-subscription__container">
        <h2 class="title mb-3 text-center" data-aos="fade-up">@lang('dinway.news-subscription.title')</h2>
        <div class="news-subscription__content">
            <img data-src="{{asset('img/frontsite/subscribe/subscribe.png')}}" class="news-subscription__img lazyload" data-aos="fade-right"/>
            <form class="subscribe-form news-subscription__form" action="{{route('website.news-subscribe')}}" data-form-validation method="post" data-aos="fade-left">
                @csrf
                <div class="mb-1">
                    <div>
                        <label class="">
                            <span class="subscribe-form__text">@lang('dinway.news-subscription.email')</span> 
                            <input  class="subscribe-form__input" 
                                    type="email" 
                                    name="email" 
                                    data-validation="email">
                        </label>
                    </div>
                    <div class="invalid-feedback" data-error="email">
                        @error('email')
                            {{$message}}
                        @enderror
                    </div>
                    <div>
                        <p class="mb-1">@lang('dinway.news-subscription.period.title')</p> 
                        <label>
                            <input type="radio" value="week" name="period" checked>
                            @lang('dinway.news-subscription.period.week')
                        </label>
                        <label>
                            <input type="radio" value="month" name="period">
                            @lang('dinway.news-subscription.period.month')
                        </label>
                    </div>
                    <div class="invalid-feedback" data-error="email">
                        @error('period')
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="subscribe-form__btns">
                    <button type="submit" class="btn-transparent">
                        @lang('dinway.news-subscription.submit')
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>


