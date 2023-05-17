@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="as-content">
            @include('includes.partials.messages')
            <div class="ac-block grey-border-gg">
                <div class="ac--block-title">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 512 512"
                     width="512" height="512">
                            <path d="M320.822,335.362a6,6,0,0,0,2.192-9.882L279.5,281.965a44.282,44.282,0,0,0-61.846-61.847L174.134,176.6a6,6,0,0,0-9.882,2.192L128.43,277.306a237.144,237.144,0,0,1-54.816,86.071,25.14,25.14,0,0,0,0,35.555L100.683,426a25.139,25.139,0,0,0,35.554,0c.165-.165.336-.323.5-.488l55.979,55.98a6,6,0,0,0,8.485,0,44.331,44.331,0,0,0,0-62.624l-24.942-24.942a235.979,235.979,0,0,1,46.048-22.742ZM266.481,233.133a32.286,32.286,0,0,1,4.384,40.2l-44.578-44.578A32.332,32.332,0,0,1,266.481,233.133ZM118.46,421.365a13.055,13.055,0,0,1-9.292-3.849L82.1,390.446a13.139,13.139,0,0,1,0-18.583q7.013-7.014,13.452-14.606l46.806,46.806q-7.578,6.437-14.605,13.453A13.055,13.055,0,0,1,118.46,421.365Zm74.258,5.989a32.3,32.3,0,0,1,3.851,41.02l-51.1-51.1a236.411,236.411,0,0,1,20.661-16.507Zm-40.966-30.866-48.625-48.626a249.174,249.174,0,0,0,36.58-66.456l32.6-89.658L307.867,327.3l-89.659,32.6A249.164,249.164,0,0,0,151.752,396.488Z"/><path
                            d="M308.979,203.5a65.1,65.1,0,0,0-70.466-14.376A6,6,0,1,0,243,200.256a53.195,53.195,0,0,1,69.218,69.219,6,6,0,1,0,11.131,4.484A65.091,65.091,0,0,0,308.979,203.5Z"/><path
                            d="M344.734,288.438a6,6,0,0,0,7.808-3.324A96.2,96.2,0,0,0,227.358,159.931a6,6,0,1,0,4.485,11.13A84.2,84.2,0,0,1,341.411,280.63,6,6,0,0,0,344.734,288.438Z"/><path
                            d="M411.625,10A90.375,90.375,0,1,0,502,100.375,90.477,90.477,0,0,0,411.625,10Zm0,168.75A78.375,78.375,0,1,1,490,100.375,78.464,78.464,0,0,1,411.625,178.75Z"/><path
                            d="M444.087,89.879a22.437,22.437,0,1,0-22.434-22.532L393.828,83.416a22.436,22.436,0,1,0-.577,34.4l28.528,17.875a22.454,22.454,0,1,0,2.378-12.672l-23.908-14.98a22.41,22.41,0,0,0,.243-14.617l24.533-14.168A22.439,22.439,0,0,0,444.087,89.879Zm0-32.873a10.437,10.437,0,1,1-10.436,10.437A10.449,10.449,0,0,1,444.087,57.006Zm-64.924,53.806A10.437,10.437,0,1,1,389.6,100.375,10.449,10.449,0,0,1,379.163,110.812Zm64.924,12.059a10.437,10.437,0,1,1-10.436,10.436A10.448,10.448,0,0,1,444.087,122.871Z"/><path
                            d="M411.625,321.25A90.375,90.375,0,1,0,502,411.625,90.477,90.477,0,0,0,411.625,321.25Zm0,168.75A78.375,78.375,0,1,1,490,411.625,78.464,78.464,0,0,1,411.625,490Z"/><path
                            d="M448.731,406.522l-49.15-30.4a6,6,0,0,0-9.156,5.1v60.8a6,6,0,0,0,9.156,5.1l49.15-30.4a6,6,0,0,0,0-10.206Zm-46.306,24.737V391.991l31.744,19.634Z"/><path
                            d="M100.375,190.75A90.375,90.375,0,1,0,10,100.375,90.477,90.477,0,0,0,100.375,190.75Zm0-168.75A78.375,78.375,0,1,1,22,100.375,78.464,78.464,0,0,1,100.375,22Z"/><path
                            d="M63.5,136.257h42.939a16.018,16.018,0,0,0,16-16v-.952l21.925,12.03a6,6,0,0,0,8.886-5.26v-51.4a6,6,0,0,0-8.887-5.259L122.439,81.449v-.956a16.018,16.018,0,0,0-16-16H63.5a16.017,16.017,0,0,0-16,16v39.764A16.017,16.017,0,0,0,63.5,136.257Zm77.75-51.444v31.125l-18.811-10.321V95.138ZM59.5,80.493a4,4,0,0,1,4-4h42.939a4,4,0,0,1,4,4v39.764a4,4,0,0,1-4,4H63.5a4,4,0,0,1-4-4Z"/>
                        </svg>
                    </span>
                    <h3>{{ __('strings.backend.advertising.header') }}</h3>
                </div>
                <div class="ac--block-contents">
                    <div class="block-contents--about">
                        <p>{{ __('strings.backend.advertising.text') }}</p>
                    </div>
                    <div class="block-contents--banners">
                        <div class="banner-block">
                            <div class="bb-img">
                                <img src="{{ asset('/backend/img/banners/bnf-Fen24 300-600.png') }}" alt="Fenix24">
                            </div>
                            <div class="bb-btn">
                                <a href="{{ asset('/backend/archive/bnf-Fen24.zip') }}" class="bb-btn--download">{{ __('strings.backend.advertising.download') }}</a>
                            </div>
                        </div>
                        <div class="banner-block">
                            <div class="bb-img">
                                <img src="{{ asset('/backend/img/banners/bnf-liberty 300-600.png') }}" alt="Fenix24">
                            </div>
                            <div class="bb-btn">
                                <a href="{{ asset('/backend/archive/bnf-liberty.zip') }}" class="bb-btn--download">{{ __('strings.backend.advertising.download') }}</a>
                            </div>
                        </div>
                        <div class="banner-block">
                            <div class="bb-img">
                                <img src="{{ asset('/backend/img/banners/bnf-money 300-600.png') }}" alt="Fenix24">
                            </div>
                            <div class="bb-btn">
                                <a href="{{ asset('/backend/archive/bnf-money.zip') }}" class="bb-btn--download">{{ __('strings.backend.advertising.download') }}</a>
                            </div>
                        </div>

                        {{-- Интерактивное окно для скачивания баннеров НАДО ДОРАБОТАТЬ --}}
                        {{-- <section class="banner-window">
                            <div class="bw-block">
                                <div class="bwb--banner-view">
                                    <div class="banner-view--control">
                                        <button class="bvc--btn"></button>
                                        <button class="bvc--btn"></button>
                                        <button class="bvc--btn"></button>
                                        <button class="bvc--btn"></button>
                                        <button class="bvc--btn"></button>
                                        <button class="bvc--btn"></button>
                                    </div>
                                    <div class="banner-view--result">
                                        <div class="bvr--window">
                                            <div class="bvr--window--img">
                                                <img src="{{ asset('backend/img/banners/') }}" alt="Fenix24">
                                            </div>
                                            <div class="bvr--window--img">
                                                <img src="{{ asset('backend/img/banners/') }}" alt="Fenix24">
                                            </div>
                                            <div class="bvr--window--img">
                                                <img src="{{ asset('backend/img/banners/') }}" alt="Fenix24">
                                            </div>
                                            <div class="bvr--window--img">
                                                <img src="{{ asset('backend/img/banners/') }}" alt="Fenix24">
                                            </div>
                                            <div class="bvr--window--img">
                                                <img src="{{ asset('backend/img/banners/') }}" alt="Fenix24">
                                            </div>
                                            <div class="bvr--window--img">
                                                <img src="{{ asset('backend/img/banners/') }}" alt="Fenix24">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> --}}
                    </div>
                </div>
            </div>

            {{-- Блок для отзывов --}}
            <div class="testimonials-block grey-border-gg">
                <div class="bg"></div>
                <div class="title">
                    <h4>{{ __('cabinet.adversting.title') }}</h4>
                </div>
                <div class="content">
                    <p>@lang('cabinet.adversting.sub-title', ['one_sum' => '1.5', 'max_ttm' => '8', 'max_sum' => '25'])</p>
                    <button class="mw-control-btn" data-findmodal="testimonials-form">{{ __('cabinet.adversting.ttm-btn') }}</button>
                </div>
            </div>
            {{-- Форма для отзывов --}}
            @include('backend.includes.partials.forms.testimonial')

            <div class="ac-block grey-border-gg">
                <div class="ac--block-title">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 512 512"
                     width="512" height="512">
                            <path d="M320.822,335.362a6,6,0,0,0,2.192-9.882L279.5,281.965a44.282,44.282,0,0,0-61.846-61.847L174.134,176.6a6,6,0,0,0-9.882,2.192L128.43,277.306a237.144,237.144,0,0,1-54.816,86.071,25.14,25.14,0,0,0,0,35.555L100.683,426a25.139,25.139,0,0,0,35.554,0c.165-.165.336-.323.5-.488l55.979,55.98a6,6,0,0,0,8.485,0,44.331,44.331,0,0,0,0-62.624l-24.942-24.942a235.979,235.979,0,0,1,46.048-22.742ZM266.481,233.133a32.286,32.286,0,0,1,4.384,40.2l-44.578-44.578A32.332,32.332,0,0,1,266.481,233.133ZM118.46,421.365a13.055,13.055,0,0,1-9.292-3.849L82.1,390.446a13.139,13.139,0,0,1,0-18.583q7.013-7.014,13.452-14.606l46.806,46.806q-7.578,6.437-14.605,13.453A13.055,13.055,0,0,1,118.46,421.365Zm74.258,5.989a32.3,32.3,0,0,1,3.851,41.02l-51.1-51.1a236.411,236.411,0,0,1,20.661-16.507Zm-40.966-30.866-48.625-48.626a249.174,249.174,0,0,0,36.58-66.456l32.6-89.658L307.867,327.3l-89.659,32.6A249.164,249.164,0,0,0,151.752,396.488Z"/><path
                            d="M308.979,203.5a65.1,65.1,0,0,0-70.466-14.376A6,6,0,1,0,243,200.256a53.195,53.195,0,0,1,69.218,69.219,6,6,0,1,0,11.131,4.484A65.091,65.091,0,0,0,308.979,203.5Z"/><path
                            d="M344.734,288.438a6,6,0,0,0,7.808-3.324A96.2,96.2,0,0,0,227.358,159.931a6,6,0,1,0,4.485,11.13A84.2,84.2,0,0,1,341.411,280.63,6,6,0,0,0,344.734,288.438Z"/><path
                            d="M411.625,10A90.375,90.375,0,1,0,502,100.375,90.477,90.477,0,0,0,411.625,10Zm0,168.75A78.375,78.375,0,1,1,490,100.375,78.464,78.464,0,0,1,411.625,178.75Z"/><path
                            d="M444.087,89.879a22.437,22.437,0,1,0-22.434-22.532L393.828,83.416a22.436,22.436,0,1,0-.577,34.4l28.528,17.875a22.454,22.454,0,1,0,2.378-12.672l-23.908-14.98a22.41,22.41,0,0,0,.243-14.617l24.533-14.168A22.439,22.439,0,0,0,444.087,89.879Zm0-32.873a10.437,10.437,0,1,1-10.436,10.437A10.449,10.449,0,0,1,444.087,57.006Zm-64.924,53.806A10.437,10.437,0,1,1,389.6,100.375,10.449,10.449,0,0,1,379.163,110.812Zm64.924,12.059a10.437,10.437,0,1,1-10.436,10.436A10.448,10.448,0,0,1,444.087,122.871Z"/><path
                            d="M411.625,321.25A90.375,90.375,0,1,0,502,411.625,90.477,90.477,0,0,0,411.625,321.25Zm0,168.75A78.375,78.375,0,1,1,490,411.625,78.464,78.464,0,0,1,411.625,490Z"/><path
                            d="M448.731,406.522l-49.15-30.4a6,6,0,0,0-9.156,5.1v60.8a6,6,0,0,0,9.156,5.1l49.15-30.4a6,6,0,0,0,0-10.206Zm-46.306,24.737V391.991l31.744,19.634Z"/><path
                            d="M100.375,190.75A90.375,90.375,0,1,0,10,100.375,90.477,90.477,0,0,0,100.375,190.75Zm0-168.75A78.375,78.375,0,1,1,22,100.375,78.464,78.464,0,0,1,100.375,22Z"/><path
                            d="M63.5,136.257h42.939a16.018,16.018,0,0,0,16-16v-.952l21.925,12.03a6,6,0,0,0,8.886-5.26v-51.4a6,6,0,0,0-8.887-5.259L122.439,81.449v-.956a16.018,16.018,0,0,0-16-16H63.5a16.017,16.017,0,0,0-16,16v39.764A16.017,16.017,0,0,0,63.5,136.257Zm77.75-51.444v31.125l-18.811-10.321V95.138ZM59.5,80.493a4,4,0,0,1,4-4h42.939a4,4,0,0,1,4,4v39.764a4,4,0,0,1-4,4H63.5a4,4,0,0,1-4-4Z"/>
                        </svg>
                    </span>
                    <h3>{{ __('strings.backend.advertising-reward.header') }}</h3>
                </div>
                <div class="container ac--reward">
                    <div class="row">
                        <div class="col-lg-12">
                            <p>{{ __('strings.backend.advertising-reward.text') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ac--reward-block">
                                <div class="reward-block--title">
                                    <h4>{{ __('strings.backend.advertising-reward.reward-block.title1') }}</h4>
                                </div>
                                <div class="reward-block--info">
                                    <div class="rbi--sum">
                                        <h3>{{ __('strings.backend.advertising-reward.reward-block.sum1') }}</h3>
                                    </div>
                                    <div class="rbi--sum">
                                        <small>{{ __('strings.backend.advertising-reward.reward-block.info-sum') }}</small>
                                    </div>
                                </div>
                                <div class="reward-block--control">
                                    <button class="rbc--btn gr-feedback-open">{{ __('strings.backend.advertising-reward.reward-block.conditions') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ac--reward-block">
                                <div class="reward-block--title">
                                    <h4>{{ __('strings.backend.advertising-reward.reward-block.title2') }}<a href="https://telegram.me/fenix24public">Telegram</a></h4>
                                </div>
                                <div class="reward-block--info">
                                    <div class="rbi--sum">
                                        <h3>{{ __('strings.backend.advertising-reward.reward-block.sum2') }}</h3>
                                    </div>
                                    <div class="rbi--sum">
                                        <small>{{ __('strings.backend.advertising-reward.reward-block.info-sum') }}</small>
                                    </div>
                                </div>
                                <div class="reward-block--control">
                                    <button class="rbc--btn gr-feedback-open">{{ __('strings.backend.advertising-reward.reward-block.conditions') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ac--reward-block">
                                <div class="reward-block--title">
                                    <h4>{{ __('strings.backend.advertising-reward.reward-block.title3') }}</h4>
                                </div>
                                <div class="reward-block--info">
                                    <div class="rbi--sum">
                                        <h3>{{ __('strings.backend.advertising-reward.reward-block.sum3') }}</h3>
                                    </div>
                                    <div class="rbi--sum">
                                        <small>{{ __('strings.backend.advertising-reward.reward-block.info-sum') }}</small>
                                    </div>
                                </div>
                                <div class="reward-block--control">
                                    <button class="rbc--btn gr-feedback-open">{{ __('strings.backend.advertising-reward.reward-block.conditions') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ac--reward-block">
                                <div class="reward-block--title">
                                    <h4>{{ __('strings.backend.advertising-reward.reward-block.title4') }}</h4>
                                </div>
                                <div class="reward-block--info">
                                    <div class="rbi--sum">
                                        <h3>{{ __('strings.backend.advertising-reward.reward-block.sum4') }}</h3>
                                    </div>
                                    <div class="rbi--sum">
                                        <small>{{ __('strings.backend.advertising-reward.reward-block.info-sum') }}</small>
                                    </div>
                                </div>
                                <div class="reward-block--control">
                                    <button class="rbc--btn gr-feedback-open">{{ __('strings.backend.advertising-reward.reward-block.conditions') }}</button>
                                </div>
                            </div>
                        </div>

                        {{-- Форма обратной связи --}}
                        <section class="gr-feedback">
                            <div class="gr-feedback-wrapper">
                                <div class="gr-fw-background"></div>
                                <div class="gr-fw-content">
                                    <form action="{{ route('home.request-advertising-material') }}"
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

                                        {{-- E-mail --}}
                                        <div class="gr-fwc-data">
                                            <label for="email">E-mail</label>
                                            <input class="gr-fwc-data--input" 
                                                    type="text" 
                                                    name="email" 
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
                                            <strong>{{ __('feedback.feedback.comment-advertising') }}</strong>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
