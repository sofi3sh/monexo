<!-- Форма обратной связи -->
<div class="modal micromodal-slide" id="modal-feedback" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal__close" aria-label="@lang('dinway.modal-feedback.close')" data-micromodal-close>X</button>
            <div class="modal__header">
                <h3 class="modal__title" id="modal-title">
                    @lang('dinway.modal-feedback.title')
                </h3>
            </div>
            <form class="modal-form">
                <div class="modal__content" id="modal-content">
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-feedback.name')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-feedback.placeholder')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-feedback.contact')
                        </span>
                        <input class="modal__input" type="text" placeholder="@monexo_support">
                    </label>
                    <span class="modal__label-title">
                        @lang('dinway.modal-feedback.messenger')
                    </span>
                    <div class="modal-select" data-state>
                        <div class="modal-select__title" data-default="Telegram">Telegram</div>
                        <div class="modal-select__content">
                            <input id="feedback-modal__option-0" class="modal-select__input" type="radio" checked />
                            <label for="feedback-modal__option-0" class="modal-select__label">Telegram</label>
                            <input id="feedback-modal__option-1" class="modal-select__input" type="radio"/>
                            <label for="feedback-modal__option-1" class="modal-select__label">Telegram</label>
                            <input id="feedback-modal__option-2" class="modal-select__input" type="radio" />
                            <label for="feedback-modal__option-2" class="modal-select__label">Viber</label>
                            <input id="feedback-modal__option-3" class="modal-select__input" type="radio"/>
                            <label for="feedback-modal__option-3" class="modal-select__label">Whatsapp</label>
                        </div>
                    </div>
                </div>
                <div class="modal__footer">
                    <button type="submit" class="modal__btn btn-blue">@lang('dinway.modal-feedback.send')</button>
                </div>
            </form>
        </div>
    </div>
</div>
