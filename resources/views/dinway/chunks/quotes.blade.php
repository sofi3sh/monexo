@if($quote)
    <section id="quotes-section" class="quotes section">
        <div class="container quotes__container">
            <div class="quotes__content" class="aos-init aos-animate" data-aos="zoom-in">
                <h2 class="quotes__title">"{{ $quote->text }}"</h2>
                <h3 class="quotes__author">&mdash; {{ $quote->author }}</h3>
            </div>
        </div>
    </section>
@endif
