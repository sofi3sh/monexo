<section class="section bizes">
    <div class="container bizes__container">
        <!-- <h2 class="title bizes__title">@lang('dinway.businesspack.bizes.title')</h2> -->
        @include('dinway.chunks.investments.simple-slider')
        <div class="bizes-offer">
            <h3 class="title bizes-offer__title" data-aos="zoom-in">@lang('dinway.businesspack.bizes.free_consultation')</h3>
            <p class="bizes-offer__subtitle" data-aos="zoom-in">@lang('dinway.businesspack.bizes.free_consultation_descr')</p>
            <a
               href="#tickets"
               class="btn-white biz__btn" data-aos="zoom-in" >@lang('dinway.businesspack.bizes.button')</a>
            {{-- <button class="btn-white biz__btn" data-aos="zoom-in"  data-micromodal-trigger="modal-feedback">@lang('dinway.businesspack.bizes.button')</button> --}}
            <img class="bizes-offer__flower" src="{{asset('img/frontsite/bizes/flower.svg')}}" alt aria-hidden="true">
        </div>
    </div>
</section>
