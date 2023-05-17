<!-- Линейная программа -->
<div class="modal micromodal-slide modal-linear-program" id="modal-linear-program" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal__close" aria-label="@lang('dinway.modal-linear-program.close')" data-micromodal-close>X</button>
            <div class="modal__header">
                <h3 class="modal__title" id="modal-title">
                    @lang('dinway.modal-linear-program.title')
                </h3>
            </div>
            <div class="modal__body">
                @lang('dinway.modal-linear-program.content')
            </div>
            <a
                class="modal__btn btn-blue"
                @guest
                    href="{{route('login')}}"
                @else
                    href="{{route('home.referrals')}}"
                @endguest
            >@lang('dinway.btns.more')</a>
        </div>
    </div>
</div>
