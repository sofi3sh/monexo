@extends('layouts.app')

@section('content')

    <div class="main-page">
        <div class="content--blocks-wrapper cbw-col main-last-news">
            {{-- Новость --}}
            @foreach($news as $one_news)
                <div class="mln-block bw--wrapper-md article-{{ $one_news->id }}">
                    
                    {{-- Картинка-preview новости --}}
                    @if(!is_null($one_news->getMedia('news_thumbnails')->last()))
                        <div class="mln-thumbnail" style="background: url('{{ $one_news->getMedia('news_thumbnails')->last()->getUrl('thumb') }}')">
                        </div>
                    @else
                        <div class="mln-thumbnail" style="background: url('{{ asset('backend/img/if-not-bg-news.png') }}')">
                        </div>
                    @endif

                    <div class="mln-info">
                        {{-- Заголовок новости --}}
                        <div class="mln-title">
                            <h2>{!! $one_news->header !!}</h2>
                        </div>

                        <div class="mln-tags">
                            <div class="mlnt-type">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 486.982 486.982" style="enable-background:new 0 0 486.982 486.982;" xml:space="preserve" width="512px" height="512px">
                                    <g>
                                        <g>
                                            <path d="M131.35,422.969c14.6,14.6,38.3,14.6,52.9,0l181.1-181.1c5.2-5.2,9.2-11.4,11.8-18c18.2,5.1,35.9,7.8,51.5,7.7   c38.6-0.2,51.4-17.1,55.6-27.2c4.2-10,7.2-31-19.9-58.6c-0.3-0.3-0.6-0.6-0.9-0.9c-16.8-16.8-41.2-32.3-68.9-43.8   c-5.1-2.1-10.2-4-15.2-5.8v-0.3c-0.3-22.2-18.2-40.1-40.4-40.4l-108.5-1.5c-14.4-0.2-28.2,5.4-38.3,15.6l-181.2,181.1   c-14.6,14.6-14.6,38.3,0,52.9L131.35,422.969z M270.95,117.869c12.1-12.1,31.7-12.1,43.8,0c7.2,7.2,10.1,17.1,8.7,26.4   c11.9,8.4,26.1,16.2,41.3,22.5c5.4,2.2,10.6,4.2,15.6,5.9l-0.6-43.6c0.9,0.4,1.7,0.7,2.6,1.1c23.7,9.9,45,23.3,58.7,37   c0.2,0.2,0.4,0.4,0.6,0.6c13,13.3,14.4,21.8,13.3,24.4c-3.4,8.1-39.9,15.3-95.3-7.8c-16.2-6.8-31.4-15.2-43.7-24.3   c-0.4,0.5-0.9,1-1.3,1.5c-12.1,12.1-31.7,12.1-43.8,0C258.85,149.569,258.85,129.969,270.95,117.869z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                        </g>
                                    </g>
                                </svg>
                                <span>{{ __('cabinet.main-page.news.tags') }}</span>
                            </div>
                            
                            {{-- Дата новости --}}
                            <div class="mlnt-date">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px" height="512px">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M452,40h-24V0h-40v40H124V0H84v40H60C26.916,40,0,66.916,0,100v352c0,33.084,26.916,60,60,60h392    c33.084,0,60-26.916,60-60V100C512,66.916,485.084,40,452,40z M472,452c0,11.028-8.972,20-20,20H60c-11.028,0-20-8.972-20-20V188    h432V452z M472,148H40v-48c0-11.028,8.972-20,20-20h24v40h40V80h264v40h40V80h24c11.028,0,20,8.972,20,20V148z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="76" y="230" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="156" y="230" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="236" y="230" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="316" y="230" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="396" y="230" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="76" y="310" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="156" y="310" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="236" y="310" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="316" y="310" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="76" y="390" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="156" y="390" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="236" y="390" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="316" y="390" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="396" y="310" width="40" height="40" data-original="#000000" class="active-path" data-old_color="#000000" fill="#80BB50"/>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span>{{ $one_news->created_at->format('d.m.Y') }}</span>
                            </div>
                        </div>

                        {{-- Краткое описание --}}
                        <div class="mln-text">
                            <p>{!! $one_news->short_description !!}</p>
                        </div>

                        {{-- Кнопка открытия полной новости --}}
                        <div class="mln-read-more">
                            <button data-fancybox data-src="#article-{{ $one_news->id }}">{{ __('cabinet.main-page.news.btn') }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Модальные окна с полной новостью --}}
    @foreach($news as $one_news)
        <div style="display: none;" id="article-{{ $one_news->id }}" class="article-full">
            <div class="article-full__head">
                {!! $one_news->header !!}
            </div>
            <div class="article-full__text">
                {!! $one_news->text !!}
            </div>
        </div>
    @endforeach
@endsection
