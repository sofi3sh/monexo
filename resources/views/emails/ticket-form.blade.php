<section class="section">
    <div class="container">
        <h2 class="title mb-3 text-center" data-aos="fade-up">
            @lang('ticket.front.title')
        </h2>
        <form class="tickets-form" data-form-validation>
            @csrf
            <div class="tickets-form__content" data-aos="fade-right">
                <div>
                    <div>
                        <label>
                            <span class="tickets-form__text">
                                @lang('ticket.front.name')
                            </span> 
                            <input class="tickets-form__input" type="text" ata-validation="name" name="ticket_full_name">
                        </label>
                        <div class="invalid-feedback" data-error="name"></div>
                    </div>
                    <div>   
                        <label>
                            <span class="tickets-form__text">@lang('ticket.front.email')</span>
                            <input class="tickets-form__input" type="text" data-validation="email" maxlength="255" name="ticket_email">
                        </label>
                        <div class="invalid-feedback" data-error="email"></div>
                    </div>
                    <div>
                        <label>
                            <span class="tickets-form__text">@lang('ticket.front.phone')</span>
                            <input class="tickets-form__input" type="text" data-validation="phone" name="ticket_phone">
                        </label>
                        <div class="invalid-feedback" data-error="phone"></div>
                    </div>
                    <div>
                        <span class="tickets-form__text">@lang('ticket.front.message')</span>
                        <textarea class="tickets-form__textarea" data-validation="question" name="ticket_question" rows="3" maxlength="4096"></textarea>
                        <div class="invalid-feedback" data-error="question"></div>
                    </div>
                    <button type="submit" class="btn-transparent">
                        @lang('ticket.front.submit')
                    </button>
                </div>
                <div class="image" data-aos="fade-left">
                    <img data-src="{{asset('img/frontsite/blog/subscribe/blog-subscribe.png')}}" class="news-subscription__img lazyload" />
                </div>
            </div>
        </form>
    </div>
</section>