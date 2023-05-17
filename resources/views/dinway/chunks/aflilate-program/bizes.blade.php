<section class="section bizes">
    <div class="container bizes__container">
        {{--@include('dinway.chunks.education')--}}
        <div class="bizes-offer">
            <h3 class="title bizes-offer__title text-center" data-aos="zoom-in">@lang('dinway.aflilate-program.bizes.help')</h3>
            <p class="bizes-offer__subtitle" data-aos="zoom-in">@lang('dinway.aflilate-program.bizes.bizes-offer')</p>
            {{-- <button class="btn-white biz__btn" data-aos="zoom-in"  data-micromodal-trigger="modal-feedback">@lang('dinway.aflilate-program.bizes.request')</button> --}}
            <a
                href="#tickets"
                class="btn-white biz__btn" data-aos="zoom-in" >@lang('dinway.aflilate-program.bizes.request')</a>
            <img class="bizes-offer__flower" src="{{asset('img/frontsite/bizes/flower.svg')}}" alt aria-hidden="true">
        </div>
    </div>
</section>
