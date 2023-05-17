<section class="faq section">
    <div class="container faq__container">
        <h2 class="title faq__title" data-aos="fade-up">@lang('dinway.faq.title')</h2>
        <div class="questions-wrapper">
            <div class="questions">
                <div class="questions__item" data-aos="fade-up">
                    <div class="question">
                        <p class="question__text">@lang('dinway.faq.questions.1')</p>
                        <svg class="question__arrow" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.90691 7.60752C7.12756 8.37888 5.87244 8.37888 5.0931 7.60753L0.863676 3.42149C-0.406267 2.16457 0.483796 0 2.27058 0H10.7294C12.5162 0 13.4063 2.16457 12.1363 3.42148L7.90691 7.60752Z" fill="#001032"/>
                        </svg>
                    </div>
                </div>
                <div class="questions__item" data-aos="fade-up">
                    <div class="question">
                        <p class="question__text">@lang('dinway.faq.questions.2')</p>
                        <svg class="question__arrow" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.90691 7.60752C7.12756 8.37888 5.87244 8.37888 5.0931 7.60753L0.863676 3.42149C-0.406267 2.16457 0.483796 0 2.27058 0H10.7294C12.5162 0 13.4063 2.16457 12.1363 3.42148L7.90691 7.60752Z" fill="#001032"/>
                        </svg>
                    </div>
                </div>
                <div class="questions__item" data-aos="fade-up">
                    <div class="question">
                        <p class="question__text">@lang('dinway.faq.questions.3')</p>
                        <svg class="question__arrow" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.90691 7.60752C7.12756 8.37888 5.87244 8.37888 5.0931 7.60753L0.863676 3.42149C-0.406267 2.16457 0.483796 0 2.27058 0H10.7294C12.5162 0 13.4063 2.16457 12.1363 3.42148L7.90691 7.60752Z" fill="#001032"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-btns" data-aos="fade-up">
            <a href="{{route('website.dinway-faq')}}" class="faq__btn btn-transparent" data-more>@lang('dinway.faq.button-more')</a>
        </div>
    </div>
    <script>
        window.faqQuestionCategory = "{{$category}}";
    </script>
</section>
