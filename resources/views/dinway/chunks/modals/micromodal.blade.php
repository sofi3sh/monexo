{{-- Шаблон модального окна для micrimidal --}}
<div class="modal micromodal-slide" id="{{$id}}" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal__close" aria-label="@lang('dinway.modal-feedback.close')" data-micromodal-close>X</button>
            @isset($title)
                <div class="modal__header">
                    <h3 class="modal__title" id="modal-title">
                        {!!$title!!}
                    </h3>
                </div>
            @endisset
            <div class="modal__body">
                {!!$content!!}
            </div>
            @isset($footer)
                <div class="modal__footer">
                    {!!$footer!!}
                </div>
            @endisset
        </div>
    </div>
</div>
