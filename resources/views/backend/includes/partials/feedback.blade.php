{{-- Форма обратной связи --}}
<section class="gr-feedback">
    <div class="gr-feedback-wrapper">
        <div class="gr-fw-background"></div>
        <div class="gr-fw-content">
            <form action="{{ route('home.send-feedback-form') }}"
                    method="POST"
                    class="gr-fw-form">
                @csrf
                <div class="gr-fwc-title">
                    @lang('feedback.feedback.title')
                </div>

                {{-- ФИО --}}
                <div class="gr-fwc-data">
                    <label for="fio">{{ __('feedback.feedback.fio') }}</label>
                    <input class="gr-fwc-data--input" 
                            type="text" 
                            name="fio" 
                            id="fbUserFio" 
                            value="" 
                            placeholder="">
                    <span class="required">{{ __('feedback.feedback.required') }}</span>
                </div>

                {{-- Messanger --}}
                <div class="gr-fwc-data">
                    <label for="messenger">{{ __('feedback.feedback.messagner') }}</label>
                    <input class="gr-fwc-data--input" 
                            type="text" 
                            name="messenger" 
                            id="fbUserMessagner" 
                            value="" 
                            placeholder="">
                    <span class="required">{{ __('feedback.feedback.required') }}</span>
                </div>
                
                {{-- Телефон --}}
                <div class="gr-fwc-data">
                    <label for="phone">{{ __('feedback.feedback.phone') }}</label>
                    <input class="gr-fwc-data--input" 
                            type="text" 
                            name="phone" 
                            id="fbUserPhone" 
                            value="" 
                            placeholder="">
                    <span class="required">{{ __('feedback.feedback.required') }}</span>
                </div>

                {{-- Комментарии --}}
                <div class="gr-fwc-comment">
                    <strong>{{ __('feedback.feedback.comment') }}</strong>
                    <small>{{ __('feedback.feedback.work-time') }}</small>
                </div>

                {{-- Кнопка "Отправить" --}}
                <div class="gr-fwc-submit">
                    <button class="gr-fwc-submit-btn" type="button">{{ __('feedback.feedback.submit') }}</button>
                </div>
            </form>
        </div>
        
        {{-- Кнопка "3акрыть" --}}
        <div class="gr-fw-control">
            <button class="gr-fw-close">
                <span></span>
            </button>
        </div>
    </div>
</section>