@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="learning-cards grey-border-gg">
            <div class="tb-title back-svg-title">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="31.991px" height="31.992px" viewBox="0 0 31.991 31.992" style="enable-background:new 0 0 31.991 31.992;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M6.952,17.189v5.014c0,0,4.808-2.003,9.071-2.003c4.263,0,9.072,2.003,9.072,2.003v-5.084c0,0-4.587-2.426-9.143-2.426
                                    C11.398,14.691,6.952,17.189,6.952,17.189z"/>
                                <path d="M30.188,15.995l1.804-0.97l-1.804-0.999v-0.474c0,0,0.508-2.576-2.379-1.229c-0.147,0.08-0.226,0.161-0.258,0.24
                                    L15.645,5.96L0,14.914l5.908,2.684v-0.871c0,0,4.957-2.783,10.038-2.783c5.08,0,10.193,2.705,10.193,2.705v1.521l3.262-1.752
                                    c0,2.029,0,6.369,0,7.093h-1.086v2.521l1.444-0.998l1.603,0.998V23.51h-1.174V15.995L30.188,15.995z M29.4,13.114
                                    c0,0.061,0,0.229,0,0.475l-0.952-0.528C28.795,12.831,29.4,12.512,29.4,13.114z M29.078,15.896c-0.421,0-0.764-0.341-0.764-0.762
                                    s0.343-0.763,0.764-0.763c0.422,0,0.763,0.342,0.763,0.763S29.5,15.896,29.078,15.896z"/>
                            </g>
                        </g>
                    </svg>
                </span><h2>{{ __('strings.backend.teaching.teaching-cards.title') }}</h2>
            </div>
            <div class="card-block">
                <div class="card-block--title">
                    <img src="{{ asset('backend/img/teaching/card-1-header-bg.png') }}"/>
                    <div class="card-block--title-name">
                        <h2>Easy</h2>
                    </div>
                </div>
                <div class="card-block--price">
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-price') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>299</span>
                            <small>$</small>
                        </div>
                    </div>
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-duration') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>25</span>
                            <small>{{ __('strings.backend.teaching.teaching-cards.card-duration-vl') }}</small>
                        </div>
                    </div>
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-time') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>2.5</span>
                        </div>
                    </div>
                </div>
                <div class="card-block--info">
                    @lang('strings.backend.teaching.teaching-cards.card-info-1')
                </div>
                <div class="card-block--button">
                    <button class="gr-feedback-open">{{ __('strings.backend.teaching.teaching-cards.card-start') }}</button>
                </div>
            </div>
            <div class="card-block">
                <div class="card-block--title">
                    <img src="{{ asset('backend/img/teaching/card-2-header-bg.png') }}" />
                    <div class="card-block--title-name">
                        <h2>Profi</h2>
                    </div>
                </div>
                <div class="card-block--price">
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-price') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>1250</span>
                            <small>$</small>
                        </div>
                    </div>
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-duration') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>35</span>
                            <small>{{ __('strings.backend.teaching.teaching-cards.card-duration-vl') }}</small>
                        </div>
                    </div>
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-time') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>8</span>
                        </div>
                    </div>
                </div>
                <div class="card-block--info">
                    @lang('strings.backend.teaching.teaching-cards.card-info-2')
                </div>
                <div class="card-block--button">
                    <button class="gr-feedback-open">{{ __('strings.backend.teaching.teaching-cards.card-start') }}</button>
                </div>
            </div>
            <div class="card-block">
                <div class="card-block--title">
                    <img src="{{ asset('backend/img/teaching/card-3-header-bg.png') }}" />
                    <div class="card-block--title-name">
                        <h2>Teacher</h2>
                    </div>
                </div>
                <div class="card-block--price">
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-teacher-income') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>250~3000</span>
                            <small>$</small>
                        </div>
                    </div>
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-teacher-price') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>100</span>
                            <small>$</small>
                        </div>
                    </div>
                    <div class="card-block--price-item">
                        <div class="card-block--price-item-name">{{ __('strings.backend.teaching.teaching-cards.card-teacher-time') }}:</div>
                        <div class="card-block--price-item-value">
                            <span>35</span>
                            <small>{{ __('strings.backend.teaching.teaching-cards.card-duration-vl') }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-block--info">
                    @lang('strings.backend.teaching.teaching-cards.card-info-3')
                </div>
                <div class="card-block--button">
                    <button class="gr-feedback-open">{{ __('strings.backend.teaching.teaching-cards.card-teacher-start') }}</button>
                </div>
            </div>
        </div>
        <div class="teaching-block grey-border-gg">
            <div class="tb-title back-svg-title">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="31.991px" height="31.992px" viewBox="0 0 31.991 31.992" style="enable-background:new 0 0 31.991 31.992;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M6.952,17.189v5.014c0,0,4.808-2.003,9.071-2.003c4.263,0,9.072,2.003,9.072,2.003v-5.084c0,0-4.587-2.426-9.143-2.426
                                    C11.398,14.691,6.952,17.189,6.952,17.189z"/>
                                <path d="M30.188,15.995l1.804-0.97l-1.804-0.999v-0.474c0,0,0.508-2.576-2.379-1.229c-0.147,0.08-0.226,0.161-0.258,0.24
                                    L15.645,5.96L0,14.914l5.908,2.684v-0.871c0,0,4.957-2.783,10.038-2.783c5.08,0,10.193,2.705,10.193,2.705v1.521l3.262-1.752
                                    c0,2.029,0,6.369,0,7.093h-1.086v2.521l1.444-0.998l1.603,0.998V23.51h-1.174V15.995L30.188,15.995z M29.4,13.114
                                    c0,0.061,0,0.229,0,0.475l-0.952-0.528C28.795,12.831,29.4,12.512,29.4,13.114z M29.078,15.896c-0.421,0-0.764-0.341-0.764-0.762
                                    s0.343-0.763,0.764-0.763c0.422,0,0.763,0.342,0.763,0.763S29.5,15.896,29.078,15.896z"/>
                            </g>
                        </g>
                    </svg>
                </span><h2>{{ __('strings.backend.teaching.header') }}</h2>
            </div>
            <div class="tb-content">
                <div class="tbc--info">
                    <h4>{{ __('strings.backend.teaching.sub_header') }}</h4>
                    <p>{{ __('strings.backend.teaching.main_text') }}</p>
                </div>
                <div class="tbc--check">
                    <div class="tbc--check-info">
                        <h5>{{ __('strings.backend.teaching.complete_course_and_get') }}</h5>
                        <span>
                            <h5>
                            @lang('strings.backend.teaching.complete_course_bounce')
                            </h5>
                            <h5 class="sum">100$</h5>
                        </span>
                    </div>
                    <div class="tbc--check-btn">
                        <button class="gr-feedback-open">{{ __('strings.backend.teaching.start_course') }}</button>
                        @include('backend.includes.partials.feedback')
                    </div>
                </div>
            </div>

            <div class="tb-bg-elements">
                <div class="bg-wm">
                    <img src="{{ asset('backend/img/teaching/teaching-wm.png') }}" alt="">
                </div>
                <div class="bg-1">
                    <img src="{{ asset('backend/img/teaching/teaching-bg.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="white-block grey-border-gg">
            <div class="tb-title back-svg-title">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="31.991px" height="31.992px" viewBox="0 0 31.991 31.992" style="enable-background:new 0 0 31.991 31.992;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M6.952,17.189v5.014c0,0,4.808-2.003,9.071-2.003c4.263,0,9.072,2.003,9.072,2.003v-5.084c0,0-4.587-2.426-9.143-2.426
                                    C11.398,14.691,6.952,17.189,6.952,17.189z"/>
                                <path d="M30.188,15.995l1.804-0.97l-1.804-0.999v-0.474c0,0,0.508-2.576-2.379-1.229c-0.147,0.08-0.226,0.161-0.258,0.24
                                    L15.645,5.96L0,14.914l5.908,2.684v-0.871c0,0,4.957-2.783,10.038-2.783c5.08,0,10.193,2.705,10.193,2.705v1.521l3.262-1.752
                                    c0,2.029,0,6.369,0,7.093h-1.086v2.521l1.444-0.998l1.603,0.998V23.51h-1.174V15.995L30.188,15.995z M29.4,13.114
                                    c0,0.061,0,0.229,0,0.475l-0.952-0.528C28.795,12.831,29.4,12.512,29.4,13.114z M29.078,15.896c-0.421,0-0.764-0.341-0.764-0.762
                                    s0.343-0.763,0.764-0.763c0.422,0,0.763,0.342,0.763,0.763S29.5,15.896,29.078,15.896z"/>
                            </g>
                        </g>
                    </svg>
                </span><h2>{{ __('strings.backend.teaching.teaching-steps.how-it-work') }}</h2>
            </div>
            <div class="teaching-steps">
                <div class="step">
                    <div class="step-logo">
                        <span>
                            <small>
                                <h5>1</h5>
                                <span>{{ __('strings.backend.teaching.teaching-steps.step') }}</span>
                            </small>
                            <img src="{{ asset('backend/img/teaching/1.png') }}" alt="">
                            <img src="{{ asset('backend/img/teaching/shadow.png') }}" alt="" class="ts--shadow">
                        </span>
                    </div>
                    <div class="step-separate">
                        <span></span>
                    </div>
                    <div class="step-info">
                        <div class="si--title">
                            <h4>
                                @lang('strings.backend.teaching.teaching-steps.step1-title')
                            </h4>
                        </div>
                        <div class="si--text">
                            <p>{{ __('strings.backend.teaching.teaching-steps.step1-info') }}</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="step-logo">
                        <span>
                            <small>
                                <h5>2</h5>
                                <span>{{ __('strings.backend.teaching.teaching-steps.step') }}</span>
                            </small>
                            <img src="{{ asset('backend/img/teaching/2.png') }}" alt="">
                            <img src="{{ asset('backend/img/teaching/shadow.png') }}" alt="" class="ts--shadow">
                        </span>
                    </div>
                    <div class="step-separate">
                        <span></span>
                    </div>
                    <div class="step-info">
                        <div class="si--title">
                            <h4>
                                @lang('strings.backend.teaching.teaching-steps.step2-title')
                            </h4>
                        </div>
                        <div class="si--text">
                            <p>{{ __('strings.backend.teaching.teaching-steps.step2-info') }}</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="step-logo">
                        <span>
                            <small>
                                <h5>3</h5>
                                <span>{{ __('strings.backend.teaching.teaching-steps.step') }}</span>
                            </small>
                            <img src="{{ asset('backend/img/teaching/3.png') }}" alt="">
                            <img src="{{ asset('backend/img/teaching/shadow.png') }}" alt="" class="ts--shadow">
                        </span>
                    </div>
                    <div class="step-separate">
                        <span></span>
                    </div>
                    <div class="step-info">
                        <div class="si--title">
                            <h4>
                                @lang('strings.backend.teaching.teaching-steps.step3-title')
                            </h4>
                        </div>
                        <div class="si--text">
                            <p>{{ __('strings.backend.teaching.teaching-steps.step3-info') }}</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="step-logo">
                        <span>
                            <small>
                                <h5>4</h5>
                                <span>{{ __('strings.backend.teaching.teaching-steps.step') }}</span>
                            </small>
                            <img src="{{ asset('backend/img/teaching/4.png') }}" alt="">
                            <img src="{{ asset('backend/img/teaching/shadow.png') }}" alt="" class="ts--shadow">
                        </span>
                    </div>
                    <div class="step-separate">
                        <span></span>
                    </div>
                    <div class="step-info">
                        <div class="si--title">
                            <h4>
                                @lang('strings.backend.teaching.teaching-steps.step4-title')
                            </h4>
                        </div>
                        <div class="si--text">
                            <p>{{ __('strings.backend.teaching.teaching-steps.step4-info') }}</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="step-logo">
                        <span>
                            <small>
                                <h5>5</h5>
                                <span>{{ __('strings.backend.teaching.teaching-steps.step') }}</span>
                            </small>
                            <img src="{{ asset('backend/img/teaching/5.png') }}" alt="">
                            <img src="{{ asset('backend/img/teaching/shadow.png') }}" alt="" class="ts--shadow">
                        </span>
                    </div>
                    <div class="step-separate">
                        <span></span>
                    </div>
                    <div class="step-info">
                        <div class="si--title">
                            <h4>
                                @lang('strings.backend.teaching.teaching-steps.step5-title')
                            </h4>
                        </div>
                        <div class="si--text">
                            <p>{{ __('strings.backend.teaching.teaching-steps.step5-info') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
