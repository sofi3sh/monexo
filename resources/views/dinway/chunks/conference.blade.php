<section class="conference section">
    <h2 class="conference__title title">@lang('dinway.conference.title')</h2>
    <div class="container conference__container">
        <div class="conference-text" data-aos="fade-right">
            <p class="conference-text__item">@lang('dinway.conference.descr1')</p>
            <p class="conference-text__item">@lang('dinway.conference.descr2')</p>
            <a aria-label="Узнать подробнее о компании" href="https://t.me/dinwaycommunity" class="conference__btn btn-blue">@lang('dinway.conference.btn')</a>
        </div>
        <div class="conference-img" data-aos="fade-left">
            <picture>
                        
                <img class="conference-img__image" src="{{asset('img/frontsite/conference/conference-img-md.svg')}}" data-srcset="{{asset('img/frontsite/conference/conference-img.svg 900w')}}"> alt="">
            </picture>
            <div class="conference-img__video video">
                <iframe title="Мы на пороге грандиозного открытия" class="video__embed"
                        title="Мы на пороге грандиозного открытия" src="https://www.youtube.com/embed/zFTl3f6Le-Y">
                </iframe>
                <a aria-label="Перейти к видео на youtube" class="video__link" href="https://youtu.be/zFTl3f6Le-Y">
                    <img class="video__media lazyload" data-src="https://i.ytimg.com/vi/zFTl3f6Le-Y/maxresdefault.jpg" alt="">
                </a>
                <button class="video__button" aria-label="@lang('dinway.conference.run-video')">
                    <svg width="68" height="48" viewBox="0 0 68 48"><path class="video__button-shape" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path><path class="video__button-icon" d="M 45,24 27,14 27,34"></path></svg>
                </button>
            </div>
        </div>
    </div>
</section>
