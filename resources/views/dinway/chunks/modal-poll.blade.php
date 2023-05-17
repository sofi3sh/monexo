<!-- Заявка на аудит -->
<div class="modal modal_poll micromodal-slide" id="modal-poll" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal__close" aria-label="@lang('dinway.modal-poll.close')" data-micromodal-close>X</button>
            <div class="modal__header">
                <h3 class="modal__title" id="modal-title">
                    @lang('dinway.modal-poll.title')
                </h3>
                <span><span data-count>1</span>/10</span>
            </div>
            <form class="modal-form">
                <div class="modal__content" data-current id="modal-content">
                   <h4 class="modal-form__title">@lang('dinway.modal-poll.descr')</h4>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option1')
                        <input type="checkbox">
                       <span></span>
                    </label>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option2')
                        <input type="checkbox">
                       <span></span>
                    </label>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option3')
                       <input type="checkbox">
                       <span></span>
                    </label>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option4')
                        <input type="checkbox">
                        <span></span>
                    </label>
                </div>
                <div class="modal__content" id="modal-content">
                   <h4 class="modal-form__title">@lang('dinway.modal-poll.descr')</h4>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option1')
                        <input type="checkbox">
                       <span></span>
                    </label>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option2')
                       <input type="checkbox">
                       <span></span>
                    </label>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option3')
                       <input type="checkbox">
                       <span></span>
                    </label>
                    <label class="modal-form__checkbox">
                        @lang('dinway.modal-poll.option4')
                       <input type="checkbox">
                       <span></span>
                    </label>
                </div>
                <div class="modal__footer">
                    <button type="button" class="modal__btn btn-blue" data-click="modal-audit-next">@lang('dinway.modal-poll.next')</button>
                    <button type="submit" class="modal__btn modal__submit btn-blue">@lang('dinway.modal-poll.send')</button>
                </div>
            </form>
        </div>
    </div>
</div>
