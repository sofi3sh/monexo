<section class="bizes section">
    <div class="bizes-header">
        <div class="container bizes__container">
            <h2 class="title bizes__title">@lang('dinway.investments.bizes.title')</h2>
        </div>
    </div>
    <div class="bizes__content">
        <div class="container bizes__container">
            @include('dinway.chunks.invest-conditions')
            <div class="bizes-offer">
                <h3 class="title bizes-offer__title" data-aos="zoom-in">@lang('dinway.investments.bizes.offer')</h3>
                <p class="bizes-offer__subtitle" data-aos="zoom-in">@lang('dinway.investments.bizes.offer-descr')</p>
                <a
                   href="#tickets"
                   class="btn-white biz__btn" data-aos="zoom-in" >@lang('dinway.investments.bizes.offer-button')
                </a>
                <img class="bizes-offer__flower" src="{{asset('img/frontsite/bizes/flower.svg')}}" alt aria-hidden="true">
            </div>
        </div>
    </div>
    <img class="bizes__decor" src="{{asset('img/frontsite/decor-branch-1.svg')}}" alt aria-hidden="true">
    <img height="200" class="bizes__wave2" src="{{asset('img/frontsite/bizes/bizes-wave-2.svg')}}" alt aria-hidden="true">
</section>
