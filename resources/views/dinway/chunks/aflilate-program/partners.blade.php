<section id="partners-programs" class="section partners-programs">
    <div class="container partners-programs__container">
        <h2 class="title partners-programs__title">@lang('dinway.aflilate-program.partners.title')</h2>
        <div class="partners-programs__blocks">
            <div class="partners-programs__block partners-block" data-aos="flip-right" data-aos-duration="1000">
                <h3 class="partners-block__title">@lang('dinway.aflilate-program.partners.linear')</h3>
                <picture>
                    <source srcset="{{asset('img/frontsite/partners/partners-img-1.webp')}}" type="image/webp">
                    <img class="partners-block__image" src="{{asset('img/frontsite/partners/partners-img-1.png')}}" alt="@lang('dinway.aflilate-program.partners.alt_income_ladder')">
                </picture>
                <button class="partners-block__btn btn-transparent" data-micromodal-trigger="modal-linear-program">@lang('dinway.btns.more')</button>
            </div>
            <div class="partners-programs__block partners-block" data-aos="flip-left" data-aos-duration="1000">
                <h3 class="partners-block__title">@lang('dinway.aflilate-program.partners.career')</h3>
                <picture>
                    <source srcset="{{asset('img/frontsite/partners/partners-img-2.webp')}}" type="image/webp">
                    <img class="partners-block__image" src="{{asset('img/frontsite/partners/partners-img-2.png')}}" alt="@lang('dinway.aflilate-program.partners.alt_income_ladder')">
                </picture>
                <button class="partners-block__btn btn-transparent" data-micromodal-trigger="modal-career-program">@lang('dinway.btns.more')</button>
            </div>
        </div>
    </div>
</section>
