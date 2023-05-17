{{-- Вариант BLADE --}}
{{-- @foreach($categoriesWithQuestions as $category)
    <div>
        <strong>{{ $category->name }}</strong>

        @foreach($category->questions as $question)
            {{ $question->name }}<br>
            {{ $question->answer }}<br><br>
        @endforeach
    </div>
@endforeach --}}

{{-- @dd($categoriesWithQuestions) --}}

{{-- Вариант для JS --}}
{{-- <script>
    window.serverQuestionsItems = {!! json_encode($categoriesWithQuestions, JSON_UNESCAPED_UNICODE) !!}
</script> --}}

<section class="faq-questions">
    <div class="container faq-questions__container">
        <div class="faq-search-result"></div>
        <div class="faq-questions__content">
            <div class="faq-questions__aside">
                <div class="faq-questions-choice">
                    <span data-list-name>@lang('dinway.faq-questions.title')</span>
                </div>
                <ul id="faq-questions-list" class="faq-questions-list">
                    {{-- <li class="faq-questions-list__item faq-questions-list__item--current">
                        <button class="faq-questions-list__link" data-question="Popular">
                            @lang('dinway.faq-questions.popular')
                        </button>
                    </li>
                    <li class="faq-questions-list__item">
                        <button class="faq-questions-list__link" data-question="Blogtime">BlogTime</button>
                    </li>
                    <li class="faq-questions-list__item">
                        <button class="faq-questions-list__link" data-question="Business pack">BusinessPack</button>
                    </li>
                    <li class="faq-questions-list__item">
                        <button class="faq-questions-list__link" data-question="Affiliate program">@lang('dinway.faq-questions.program')</button>
                    </li>
                    <li class="faq-questions-list__item">
                        <button class="faq-questions-list__link" data-question="Education">Profi Universe</button>
                    </li>
                    <li class="faq-questions-list__item">
                        <button class="faq-questions-list__link" data-question="Investments">@lang('dinway.faq-questions.investments')</button>
                    </li>
                    <li class="faq-questions-list__item">
                        <button class="faq-questions-list__link" data-question="Business gaming">Business Gaming</button>
                    </li>
                    <li class="faq-questions-list__item">
                        <button class="faq-questions-list__link" data-question="Graybull">Graybull</button>
                    </li> --}}
                </ul>
            </div>
            <div class="faq-questions__qna">
                <div class="questions"></div>
                <div class="faq-questions__questions-pagination questions-pagination"></div>
            </div>

        </div>
    </div>
</section>
