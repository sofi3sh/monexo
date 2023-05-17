<!-- Заявка на аудит -->
<div class="modal modal_audit micromodal-slide" id="modal-audit" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal__close" aria-label="@lang('dinway.modal-audit.close')" data-micromodal-close>X</button>
            <div class="modal__header">
                <h3 class="modal__title" id="modal-title">
                    @lang('dinway.modal-audit.title')
                </h3>
            </div>
            <form class="modal-form">
                <div class="modal__content" data-current id="modal-content">
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.name')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.name-placeholder')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.contact')
                        </span>
                        <input class="modal__input" type="text" placeholder="@monexo_support">
                    </label>
                    <div class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.select-messenger')
                        </span>
                        <div class="modal-select" data-state>
                            <div tabindex="1" class="modal-select__title" data-default="Telegram">Telegram</div>
                            <div class="modal-select__content">
                                <input tabindex="2" id="feedback-modal__option-0" class="modal-select__input" type="radio" checked />
                                <label for="feedback-modal__option-0" class="modal-select__label">Telegram</label>
                                <input tabindex="3" id="feedback-modal__option-1" class="modal-select__input" type="radio"/>
                                <label  for="feedback-modal__option-1" class="modal-select__label">Telegram</label>
                                <input tabindex="4" id="feedback-modal__option-2" class="modal-select__input" type="radio" />
                                <label for="feedback-modal__option-2" class="modal-select__label">Viber</label>
                                <input tabindex="5" id="feedback-modal__option-3" class="modal-select__input" type="radio"/>
                                <label for="feedback-modal__option-3" class="modal-select__label">Whatsapp</label>
                            </div>
                        </div>
                    </div>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question1')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder1')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question2')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder2')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question3')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder3')">
                    </label>
                </div>
                <div class="modal__content" id="modal-content">
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question4')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder4')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question5')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder5')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question6')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder6')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question7')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder7')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question8')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder8')">
                    </label>
                    <label class="modal__label">
                        <span class="modal__label-title">
                            @lang('dinway.modal-audit.question9')
                        </span>
                        <input class="modal__input" type="text" placeholder="@lang('dinway.modal-audit.placeholder8')">
                    </label>
                </div>
                <div class="modal__footer">
                    <button type="button" class="modal__btn btn-blue" data-click="modal-audit-next">@lang('dinway.modal-audit.next')</button>
                    <button type="submit" class="modal__btn modal__submit btn-blue" >@lang('dinway.modal-audit.send')</button>
                </div>
            </form>
        </div>
    </div>
</div>
