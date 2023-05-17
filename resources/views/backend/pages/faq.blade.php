@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="page-faq">
            <div class="tabs_wrap">
                <ul class="tabs">
                    <li class="tab"><a href="#general" class="active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 24">
                                <path d="M10.118 16.064c2.293-.529 4.428-.993 3.394-2.945-3.146-5.942-.834-9.119 2.488-9.119 3.388 0 5.644 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.394 2.945 1.986.459 2.118 1.43 2.118 3.111l-.003.825h-15.994c0-2.196-.176-3.407 2.115-3.936zm-10.116 3.936h6.001c-.028-6.542 2.995-3.697 2.995-8.901 0-2.009-1.311-3.099-2.998-3.099-2.492 0-4.226 2.383-1.866 6.839.775 1.464-.825 1.812-2.545 2.209-1.49.344-1.589 1.072-1.589 2.333l.002.619z"/>
                            </svg>
                            <div>{{ __('faq.common-questions.header') }}</div>
                        </a></li>
                    <li class="tab"><a href="#operations">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm2.085 14h-9v2h9v3l5-4-5-4v3zm-4-6v-3l-5 4 5 4v-3h9v-2h-9z"/>
                            </svg>
                            <div>{{ __('faq.invest-withdrawal.header') }}</div>
                        </a></li>
                    <li class="tab"><a href="#security">
                            <svg width="24" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M3.848 19h-.848c-.796 0-1.559-.316-2.121-.879-.563-.562-.879-1.325-.879-2.121v-3c0-7.175 5.377-13 12-13s12 5.825 12 13v3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.879-2.121.879h-.848c-2.69 4.633-6.904 5-8.152 5-1.248 0-5.462-.367-8.152-5zm16.152-5.876c-.601.236-1.269-.18-1.269-.797 0-.304-.022-.61-.053-.915-1.761-.254-3.618-1.926-3.699-3.723-1.315 2.005-4.525 4.17-7.044 4.17 1.086-.699 1.839-2.773 1.903-3.508-.581 1.092-2.898 3.136-4.551 3.487l-.018.489c0 .619-.669 1.032-1.269.797v3.771c.287.256.632.464 1.041.594.225.072.412.224.521.424 2.206 4.046 5.426 4.087 6.438 4.087.929 0 3.719-.035 5.877-3.169-1.071.433-2.265.604-3.759.653-.37.6-1.18 1.016-2.118 1.016-1.288 0-2.333-.784-2.333-1.75s1.045-1.75 2.333-1.75c.933 0 1.738.411 2.112 1.005 1.9-.026 4.336-.334 5.888-2.645v-2.236zm-11-.624c.686 0 1.243.672 1.243 1.5s-.557 1.5-1.243 1.5-1.243-.672-1.243-1.5.557-1.5 1.243-1.5zm6 0c.686 0 1.243.672 1.243 1.5s-.557 1.5-1.243 1.5-1.243-.672-1.243-1.5.557-1.5 1.243-1.5zm5.478-1.5h1.357c-.856-5.118-4.937-9-9.835-9-4.898 0-8.979 3.882-9.835 9h1.357c.52-4.023 3.411-7.722 8.478-7.722s7.958 3.699 8.478 7.722z"/>
                            </svg>
                            <div>{{ __('faq.security.header') }}</div>
                        </a></li>
                    <li class="tab"><a href="#technical">
                            <svg width="24" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M3.848 19h-.848c-.796 0-1.559-.316-2.121-.879-.563-.562-.879-1.325-.879-2.121v-3c0-7.175 5.377-13 12-13s12 5.825 12 13v3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.879-2.121.879h-.848c-2.69 4.633-6.904 5-8.152 5-1.248 0-5.462-.367-8.152-5zm16.152-5.876c-.601.236-1.269-.18-1.269-.797 0-.304-.022-.61-.053-.915-1.761-.254-3.618-1.926-3.699-3.723-1.315 2.005-4.525 4.17-7.044 4.17 1.086-.699 1.839-2.773 1.903-3.508-.581 1.092-2.898 3.136-4.551 3.487l-.018.489c0 .619-.669 1.032-1.269.797v3.771c.287.256.632.464 1.041.594.225.072.412.224.521.424 2.206 4.046 5.426 4.087 6.438 4.087.929 0 3.719-.035 5.877-3.169-1.071.433-2.265.604-3.759.653-.37.6-1.18 1.016-2.118 1.016-1.288 0-2.333-.784-2.333-1.75s1.045-1.75 2.333-1.75c.933 0 1.738.411 2.112 1.005 1.9-.026 4.336-.334 5.888-2.645v-2.236zm-11-.624c.686 0 1.243.672 1.243 1.5s-.557 1.5-1.243 1.5-1.243-.672-1.243-1.5.557-1.5 1.243-1.5zm6 0c.686 0 1.243.672 1.243 1.5s-.557 1.5-1.243 1.5-1.243-.672-1.243-1.5.557-1.5 1.243-1.5zm5.478-1.5h1.357c-.856-5.118-4.937-9-9.835-9-4.898 0-8.979 3.882-9.835 9h1.357c.52-4.023 3.411-7.722 8.478-7.722s7.958 3.699 8.478 7.722z"/>
                            </svg>
                            <div>{{ __('faq.technical.header') }}</div>
                        </a></li>
                </ul>

                <div class="tabs-content">
                    <div id="general">
                        <div class="accordion">
                            <dl>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.common-questions.q1') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="false">
                                    <p>@lang('faq.common-questions.a1')</p>
                                </dd>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion2" aria-expanded="false" aria-controls="accordion2"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.common-questions.q2') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion2"
                                    aria-hidden="true">
                                    <p>@lang('faq.common-questions.a2')</p>
                                </dd>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion3" aria-expanded="false" aria-controls="accordion3"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.common-questions.q3') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion3"
                                    aria-hidden="true">
                                    <p>@lang('faq.common-questions.a3')</p>
                                </dd>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion3" aria-expanded="false" aria-controls="accordion3"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.common-questions.q4') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion4"
                                    aria-hidden="true">
                                    <p>@lang('faq.common-questions.a4')</p>
                                </dd>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion3" aria-expanded="false" aria-controls="accordion3"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.common-questions.q5') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion5"
                                    aria-hidden="true">
                                    <p>@lang('faq.common-questions.a5')</p>
                                </dd>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion3" aria-expanded="false" aria-controls="accordion3"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.common-questions.q6') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion6"
                                    aria-hidden="true">
                                    <p>@lang('faq.common-questions.a6')</p>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    {{-- Вкладка Ввод и вывод --}}
                    <div id="operations">
                        <div class="accordion">
                            <dl>
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.invest-withdrawal.q1') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.invest-withdrawal.a1') }}</p>
                                </dd>
                                <dt>
                                    <a href="#accordion2" aria-expanded="false" aria-controls="accordion2"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.invest-withdrawal.q2') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion2"
                                    aria-hidden="true">
                                    <p>{{ __('faq.invest-withdrawal.a2') }}</p>
                                </dd>
                                <dt>
                                    <a href="#accordion3" aria-expanded="false" aria-controls="accordion3"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.invest-withdrawal.q3') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion3"
                                    aria-hidden="true">
                                    <p>{{ __('faq.invest-withdrawal.a3') }}</p>
                                </dd>

                                {{-- --}}
                                <dt>
                                    <a href="#accordion3" aria-expanded="false" aria-controls="accordion3"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.invest-withdrawal.q4') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion3"
                                    aria-hidden="true">
                                    <p>{{ __('faq.invest-withdrawal.a4') }}</p>
                                </dd>

                            </dl>
                        </div>
                    </div>

                    {{-- Вкладка Безопасность --}}
                    <div id="security">
                        <div class="accordion">
                            <dl>
                                {{-- 3.1 --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.security.q1') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>@lang('faq.security.a1')</p>
                                </dd>
                                {{-- 3.2 --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.security.q2') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.security.a2') }}</p>
                                </dd>
                                {{-- 3.3 --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.security.q3') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.security.a3') }}</p>
                                </dd>
                                {{-- 3.4 --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.security.q4') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.security.a4') }}</p>
                                </dd>
                                {{-- 3.5 --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.security.q5') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.security.a5') }}</p>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    {{-- Вкладка Технические вопросы --}}
                    <div id="technical">
                        <div class="accordion">
                            <dl>
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.technical.q1') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.technical.a1') }}</p>
                                </dd>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.technical.q2') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.technical.a2') }}</p>
                                </dd>
                                {{-- --}}
                                <dt>
                                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                       class="accordion-title accordionTitle js-accordionTrigger">
                                        {{ __('faq.technical.q3') }}
                                    </a>
                                </dt>
                                <dd class="accordion-content accordionItem is-collapsed" id="accordion1"
                                    aria-hidden="true">
                                    <p>{{ __('faq.technical.a3') }}</p>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection