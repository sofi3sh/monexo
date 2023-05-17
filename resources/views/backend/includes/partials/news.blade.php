@if(!is_null($news))
    @foreach($news as $one_news)
    	<div class="col-lg-6">
	        <article class="article article-{{ $one_news->id }} main-home--news grey-border-gg">
	            <a data-fancybox data-src="#article-{{ $one_news->id }}" href="javascript:;">
	                {{-- Карточка новости --}}
	                <div class="article__card article__card-sml article__card--no-image">
	                    <div class="article__content">
	                        {{-- Заголовок новости --}}
	                        <div class="article__head">
	                            {!! $one_news->{'header_' . Lang::locale()} !!}
	                        </div>
	                    </div>
	                    <div class="article__time">
	                        {{-- Дата новости --}}
	                        <div>{{ $one_news->created_at->format('m-d-Y') }}</div>
	                    </div>
	                </div>
	            </a>

				{{-- Модальные окна с полной новостью --}}
			    <div style="display: none;" id="article-{{ $one_news->id }}" class="article-full">
			        <div class="article-full__head">
                        {!! $one_news->{'header_' . Lang::locale()} !!}
			        </div>
			        <div class="article-full__text">
                        {!! $one_news->{'text_' . Lang::locale()} !!}
			        </div>
			    </div>
	        </article>
    	</div>
    @endforeach
@endif
