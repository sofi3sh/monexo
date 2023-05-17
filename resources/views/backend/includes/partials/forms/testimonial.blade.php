{{-- Форма обратной связи --}}
<section class="gr-modalform testimonials-form">
    <div class="gr-modalform-wrapper">
        <div class="gr-mw-background"></div>
        <div class="gr-mw-content">
            <form action="{{ route('home.feedback') }}"  method="POST" class="gr-mw-form">
                @csrf
                <div class="gr-mwc-title">
                   <h2>{{ __('feedback.testimonials.title') }}</h2>
                   <small>{{ __('feedback.testimonials.sub-title') }}</small>
                </div>
                
                {{-- Список с ссылками --}}
                <div class="gr-mwc-data">
                    <div class="select-website">
                        <div class="select-list">
                            <div class="current-site">
                                <p>{{ __('feedback.testimonials.site-title') }}</p>
                                <small></small>
                            </div>
                            <div class="site-list">
                                <div class="list">
                                    <p class="item" data-sitelink="https://2ip.ru">2ip.ru</p>
                                    <p class="item" data-sitelink="https://google.com">google.com</p>
                                    <p class="item" data-sitelink="https://yahoo.com">yahoo.com</p>
                                    <p class="item" data-sitelink="https://youtube.com">youtube.com</p>
                                    <p class="item" data-sitelink="https://translate.google.com">translate.google.com</p>
                                    <p class="item" data-sitelink="https://ru.duolingo.com">ru.duolingo.com</p>
                                    <p class="item" data-sitelink="https://fiverr.com">fiverr.com</p>
                                    <p class="item" data-sitelink="https://draw.io/">draw.io</p>
                                </div>
                            </div>
                        </div>
                        <a href="#" disabled target="_blank" class="open-website blocked">{{ __('feedback.testimonials.site-go') }}</a>
                    </div>
                    <br>
                    <small>{{ __('feedback.testimonials.site-next') }}</small>
                </div>

                {{-- ФИО --}}
                <div class="gr-mwc-data">
                    <label for="fio">{{ __('feedback.feedback.fio') }}</label>
                    <input class="gr-mwc-data--input req" 
                            type="text" 
                            name="fio" 
                            id="UserFio" 
                            value="" 
                            placeholder=""
                            required>
                    <span class="required">{{ __('feedback.feedback.required') }}</span>
                </div>

                {{-- Messanger --}}
                <div class="gr-mwc-data">
                    <label for="messenger">{{ __('feedback.feedback.messagner') }}</label>
                    <input class="gr-mwc-data--input req" 
                            type="text" 
                            name="messenger" 
                            id="UserMessagner" 
                            value="" 
                            placeholder=""
                            required>
                    <span class="required">{{ __('feedback.feedback.required') }}</span>
                </div>
                
                {{-- Телефон --}}
                <div class="gr-mwc-data">
                    <label for="phone">{{ __('feedback.feedback.phone') }}</label>
                    <input class="gr-mwc-data--input req" 
                            type="text"
                            name="phone"
                            id="UserPhone"
                            value="" 
                            placeholder=""
                            required>
                    <span class="required">{{ __('feedback.feedback.required') }}</span>
                </div>
                
                {{-- Чекбоксы --}}
                <div class="gr-mwc-data">
                    <label>{{ __('feedback.testimonials.site-valid') }}</label>
                    <div class="checkbox-more-select">
                        <input type="checkbox" name="website[2ip.ru]" id="one">
                        <label for="one"><span></span> 2ip.ru</label>
                        <input type="checkbox" name="website[google.com]" id="two">
                        <label for="two"><span></span> google.com</label>
                        <input type="checkbox" name="website[yahoo.com]" id="three">
                        <label for="three"><span></span> yahoo.com</label>
                        <input type="checkbox" name="website[youtube.com]" id="four">
                        <label for="four"><span></span> youtube.com</label>
                        <input type="checkbox" name="website[translate.google.com]" id="five">
                        <label for="five"><span></span> translate.google.com</label>
                        <input type="checkbox" name="website[ru.duolingo.com]" id="six">
                        <label for="six"><span></span> ru.duolingo.com</label>
                        <input type="checkbox" name="website[fiverr.com]" id="seven">
                        <label for="seven"><span></span> fiverr.com</label>
                        <input type="checkbox" name="website[draw.io]" id="eight">
                        <label for="eight"><span></span> draw.io</label>
                    </div>
                </div>

                {{-- Комментарии от человек --}}
                <div class="gr-mwc-data">
                    <label for="comment">{{ __('feedback.testimonials.comment') }}</label>
                    <textarea name="comment" id="comment" cols="30" rows="6"></textarea>
                </div>

                {{-- Комментарии от проекта --}}
                <div class="gr-mwc-comment">
                    <span>{{ __('feedback.testimonials.last-info') }}</span>
                    <span>{{ __('feedback.testimonials.last-info-2') }}</span>
                    <small>{{ __('feedback.feedback.work-time') }}</small>
                </div>

                {{-- Кнопка "Отправить" --}}
                <div class="gr-mwc-submit">
                    <button class="gr-mwc-submit-btn" type="button">{{ __('feedback.feedback.submit') }}</button>
                </div>
            </form>
        </div>
        
        {{-- Кнопка "3акрыть" --}}
        <div class="gr-mw-control">
            <button class="close">
                <span></span>
            </button>
        </div>
    </div>
</section>