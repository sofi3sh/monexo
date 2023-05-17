@extends('dashboard.app')

@section('css')
    <style type="text/css">
        .dataTables_wrapper .dataTables_paginate a {
            padding: 8px;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate a.current {
            z-index: 3;
            color: #fff;
            border-color: #5e72e4 !important;
            background-color: #5e72e4 !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 15px;
            margin-left: 13px;
        }

        .dataTables_info {
            margin-left: -3px !important;
        }

        .dataTables_paginate.paging_simple_numbers {
            min-width: 530px;
            display: flex;
            flex-direction: row;
            align-items: baseline;
            padding-bottom: 20px;
        }

        #table-notifications td {
            vertical-align: middle;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .iti-form-country .iti--allow-dropdown .iti__flag-container,
        .iti-form-country .iti--separate-dial-code .iti__flag-container {
            right: 0;
        }

        .iti-form-country .iti__dial-code {
            display: none;
        }

        #form-country {
            background-color: #fff;
        }

        .autocomplete {
            background-color: #fff;
        }

        .autocomplete>div {
            padding: 3px;
        }

        .autocomplete>div.selected,
        .autocomplete>div:hover:not(.group) {
            background: rgba(0, 0, 0, 0.1);
            color: var(--dark);
            cursor: pointer;
        }

        .autocomplete>div.selected {
            color: var(--white) !important;
            background-color: var(--blue) !important;
        }

        .autocomplete>div:hover {
            color: var(--white);
            background-color: rgba(0, 0, 0, 0.3)
        }

        #form-telegram_verification_required {
            height: 20px;
            width: 20px;
            left: 20px;
        }

    </style>
@endsection


@section('content')
    @php
    $p = 'personal';
    if (session('page')) {
        $p = session('page');
    }
    @endphp

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="header pb-6 d-flex align-items-center"
        style="min-height: 500px; background-image: url({{ asset('images/settings-bg.jpg') }}); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">@lang('base.dash.menu.profile')</h1>
                    <p class="text-white mt-0 mb-5">@lang('base.dash.profile.info')</p>
                    <a href="#ankor" class="btn btn-neutral">@lang('base.dash.profile.button_change')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6" id="ankor">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="{{ asset('images/settings-profile.jpg') }}" alt="Image placeholder" class="card-img-top">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">{{ $quantityReferrals }}</span>
                                        <span class="description">@lang('base.dash.profile.partners')</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $profitAffiliateProgram }}</span>
                                        <span class="description">@lang('base.dash.profile.income')</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $teamTurnover }}</span>
                                        <span class="description">@lang('base.dash.profile.turnover')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">
                                {{ $user->name }}<span class="font-weight-light">, {{ $user->age }}</span>
                            </h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $user->country }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>@lang('base.dash.profile.invited')
                                - {{ isset($user->parentUser()->email) ? $user->parentUser()->email : '' }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>@lang('base.dash.profile.registered')
                                <br>{{ $user->created_at }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1" id="tab-default">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-start">
                            <div class="col-5">
                                <h3 class="mb-0">@lang('base.dash.profile.change_profile')</h3>
                            </div>
                            <div class="col-7 text-right pl-0">
                                <button class="btn btn-sm btn-primary"
                                    onclick="set_payment_tab()">@lang('base.dash.profile.button_pay')</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($showVerifAnket)
                            <div class="verif-anket">
                                <h2 class="h2 text-center">@lang('verif-anket.title')</h2>
                                <form id="anket-form" action="{{ route('home.verif.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span>@lang('verif-anket.main.surname')</span>
                                                <input name="surname" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span>@lang('verif-anket.main.name')</span>
                                                <input name="name" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label w-100">
                                                    @lang('base.dash.profile.bitrhday')
                                                    <input type="text" name="birthday" id="form-birthday-anket"
                                                        placeholder="05.02.1996" class="form-control"
                                                        value="{{ date('d.m.Y', strtotime($user->date_birthday)) }}">
                                                </label>
                                                <span class="invalid-feedback d-block"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group form-phone">
                                                <label class="form-control-label w-100">
                                                    @lang('verif-anket.main.phone')
                                                    <input class="form-control" type="phone" oninput="this.value = this.value.replace(/[^0-9\+]/i, '')" name="phone_anket">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="0" name="phone_verif" checked>
                                                    @lang('verif-anket.verif-document')
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="1" name="phone_verif">
                                                    @lang('verif-anket.verif-phone')
                                                </label>
                                              </div>
                                        </div>

                                        <div class="col-md-6 photo-container">
                                            <div class="form-group">
                                                <label class="form-control-label w-100">
                                                    @lang('verif-anket.main.document')
                                                    <input name="document" class="form-control" type="text">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col photo-container">
                                            @lang('verif-anket.main.photo')
                                            <div class="custom-file">
                                                <input name="photo" type="file" class="custom-file-input">
                                                <label class="custom-file-label">@lang('buttons.file')</label>
                                            </div>
                                        </div>

                                        <div class="col-12 pt-3">
                                            <div class="form-group step-1">
                                                @lang('verif-anket.multi-accs.title', ['href' => 'https://dinway.ai/'])
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="multi_accounts"
                                                            value="1">
                                                        @lang('verif-anket.multi-accs.answers.1')
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="multi_accounts"
                                                            value="2">
                                                        @lang('verif-anket.multi-accs.answers.2')
                                                    </label>
                                                </div>

                                                {{-- (если этот пункт отмечен - (делаем доступным пункт 3.1 --}}
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="multi_accounts"
                                                            value="3">
                                                        @lang('verif-anket.multi-accs.answers.3')
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="multi_accounts"
                                                            value="4">
                                                        @lang('verif-anket.multi-accs.answers.4')
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="step step-3 d-none">
                                                <p>@lang('verif-anket.attention')</p>
                                                <div class="form-group">
                                                    @lang('verif-anket.accs-list')
                                                    <div class="multi-accaunts mb-2">
                                                        <div class="input-group">
                                                            <input name="multi-email" type="email" class="form-control"
                                                                placeholder="email">
                                                        </div>
                                                    </div>
                                                    <button id="add-acc" onclick="addAcc()" type="button"
                                                        class="btn btn-secondary">@lang('buttons.add')</button>
                                                </div>
                                                <div class="form-group">
                                                    <span class="form-check-label">@lang('verif-anket.verif-truth')</span>
                                                    <div class="form-check">
                                                        <label class="form-check-label d-flex align-items-center">
                                                            <input name="truth-anwers" type="checkbox"
                                                                class="form-check-input">
                                                            <span class="form-text">@lang('buttons.yes-confirm')</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class="form-text mb-3">@lang('verif-anket.verif-rules')</span>
                                                <div class="form-check">
                                                    <label class="form-check-label d-flex align-items-center">
                                                        <input name="truth-rules" type="checkbox" class="form-check-input">
                                                        @lang('buttons.yes-confirm')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        @lang('buttons.send')
                                    </button>
                                </form>
                                <hr class="my-4" />
                            </div>
                        @endif
                        {{-- Временно --}}
                        {{-- <form id="main-settings-form" action="{{ route('home.profile.personal') }}" method="POST">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('base.dash.profile.info_user')</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-name">@lang('base.dash.profile.name')</label>
                                            <input type="text" name="name" id="form-name" class="form-control"
                                                placeholder="@lang('base.dash.profile.name')" value="{{ $user->name }}">
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-surname">@lang('base.dash.profile.surname')</label>
                                            <input type="text" name="surname" id="form-surname" class="form-control"
                                                placeholder="@lang('base.dash.profile.surname')"
                                                value="{{ $user->surname }}">
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-birthday">@lang('base.dash.profile.bitrhday')</label>
                                            <input type="text" name="date_birthday" id="form-birthday"
                                                placeholder="05.02.1996" class="form-control"
                                                value="{{ date('d.m.Y', strtotime($user->date_birthday)) }}">
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-city">@lang('base.dash.profile.city')</label>
                                            <input type="text" name="city" id="form-city" class="form-control"
                                                placeholder="@lang('base.dash.profile.city')" value="{{ $user->city }}">
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">

                                    @if (!config('auth.phone_verification_code.enabled'))
                                        <div class="col-md-6 d-flex align-items-center" data-form-trigger="main">
                                            <div class="d-flex align-items-center w-100"
                                                data-form-trigger="trigger-container">
                                                <span class="flex-grow-1">@lang('base.dash.profile.phone'):
                                                    {{ $user->phone }}</span>
                                                <button data-form-trigger="btn-trigger" type="button"
                                                    class="ml-3 btn btn-secondary">@lang('base.dash.btns.change')</button>
                                            </div>
                                            <div data-form-trigger="input-container" data-content="phone"
                                                class="form-group d-none w-100">
                                                <input type="hidden" name="phone" class="form-control"
                                                    value="{{ $user->phone }}" type="text">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 d-flex align-items-center" data-form-trigger="main">
                                        <div class="d-flex align-items-center w-100" data-form-trigger="trigger-container">
                                            <span class="flex-grow-1">@lang('base.dash.profile.country'):
                                                {{ $user->country }}</span>
                                            <button data-form-trigger="btn-trigger" type="button"
                                                class="ml-3 btn btn-secondary">@lang('base.dash.btns.change')</button>
                                        </div>
                                        <div data-form-trigger="input-container" data-content="country"
                                            class="form-group d-none w-100">
                                            <input type="hidden" name="country" class="form-control"
                                                value="{{ $user->country }}" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-email">@lang('base.dash.profile.email')</label>
                                            <input type="email" name="email" id="form-email" class="form-control"
                                                placeholder="@lang('base.dash.profile.email')" value="{{ $user->email }}"
                                                @if ($user->registeredViaGoogle()) disabled @endif>
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-telegram_verification_required">@lang('base.dash.profile.telegram_verification_required_label')</label>
                                            <div class="form-check pl-4">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="form-telegram_verification_required"
                                                    name="telegram_verification_required"
                                                    {{ $user->telegram_verification_required ? 'checked="checked"' : '' }}>
                                                <label class="form-check-label" for="form-telegram_verification_required">
                                                    @lang('base.dash.profile.telegram_verification_required')
                                                </label>
                                            </div>
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                        <button type="button" class="btn btn-link btn-sm m-0" data-toggle="modal"
                                            data-target="#telegram-instruction">
                                            @lang('base.dash.profile.tg-instruction.btn')
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    @lang('base.dash.profile.button_save')
                                </button>
                            </div>
                        </form> --}}
                        {{-- <hr class="my-4" /> --}}

                        @if (config('auth.phone_verification_code.enabled'))
                            <form id="change-phone-form" class="mb-3" action="{{ route('home.profile.phone') }}"
                                method="POST">
                                @csrf
                                <hr class="my-4" />
                                <h6 class="heading-small text-muted mb-4">@lang('base.dash.profile.change_phone')</h6>
                                <div class="pl-lg-4">
                                    @if ($user->phone)
                                        <div class="mb-2">@lang('base.dash.profile.phone'): {{ $user->phone }}</div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-phone">
                                                <label class="form-control-label"
                                                    for="form-new-phone">@lang('base.dash.profile.new_phone')</label>
                                                <input id="form-phone" class="form-control" value="{{ old('phone') }}"
                                                    placeholder="9999999999" type="text">
                                                <input type="hidden" value="{{ old('phone') }}" name="phone"
                                                    id="form-phone-hidden">
                                                <span class="invalid-feedback d-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="sms-confirm-code">@lang('base.dash.profile.sms_code')</label>
                                                <input id="sms-confirm-code" name="code" class="form-control"
                                                    value="{{ old('code') }}" type="text">
                                                <span class="invalid-feedback d-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-sm btn-primary"
                                                id="sendSmsCode">@lang('base.dash.profile.send_sms')</button>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-sm btn-primary mt-3">@lang('base.dash.profile.button_save')</button>
                                </div>
                            </form>
                        @endif

                        <form id="passwords-settings-form" class="mb-3" action="{{ route('home.profile.password') }}"
                            method="POST">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('base.dash.profile.change_psw')</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    @if ($user->password)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="current-password">@lang('validation.attributes.current_password')</label>
                                                <input id="current-password" name="current_password" class="form-control"
                                                    placeholder="@lang('validation.attributes.current_password')"
                                                    type="password">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-password">@lang('validation.attributes.new_password')</label>
                                            <input id="form-password" name="new_password" class="form-control"
                                                placeholder="@lang('validation.attributes.new_password')" type="password">
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="form-password-confirm">@lang('validation.attributes.new_password_confirmation')</label>
                                            <input id="form-password-confirm" name="new_password_confirmation"
                                                class="form-control"
                                                placeholder="@lang('validation.attributes.new_password_confirmation')"
                                                type="password" disabled>
                                            <span class="invalid-feedback d-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit"
                                            class="btn btn-sm btn-primary">@lang('base.dash.profile.button_save')</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form id="patch-news-form" action="{{ route('home.profile.patch-news') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <h6 class="heading-small text-muted mb-4">
                                @lang('base.dash.settings.news.title')
                            </h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label d-block" for="form-password">
                                        @lang('base.dash.settings.news.period.title')
                                    </label>
                                    @php $period = $subscribe->period ?? null  @endphp
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="period" id="period-week"
                                            value="week" @if ($period === 'week') checked @endif>
                                        <label class="form-check-label" for="period-week">
                                            @lang('base.dash.settings.news.period.week')
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="period" id="period-month"
                                            value="month" @if ($period === 'month') checked @endif>
                                        <label class="form-check-label" for="period-month">
                                            @lang('base.dash.settings.news.period.month')
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="period" id="period-never"
                                            value="never" @if ($period === 'never' || $period === null) checked @endif>
                                        <label class="form-check-label" for="period-never">
                                            @lang('base.dash.settings.news.period.never')
                                        </label>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn btn-sm btn-primary disabled">@lang('base.dash.profile.button_save')</button>
                                @if ($subscribe)
                                    <a href="{{ $unsubscribeURL }}" class="btn btn-sm btn-secondary">
                                        @lang('base.dash.settings.news.submit')
                                    </a>
                                @endif
                            </div>
                        </form>

                        @if (Auth::user()->bonus_level >= $mapSettings->level)
                            @if ($mapApp !== null)
                                <form action="{{ route('home.profile.partners-map-update') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $mapApp->id }}">
                                    <hr class="my-4" />
                                    <h6 class="heading-small text-muted mb-4">
                                        @lang('base.dash.settings.partners-map.title')
                                    </h6>
                                    <div class="form-check">
                                        @if ($mapApp->is_active)
                                            <p>
                                                <b>
                                                    @lang('base.dash.settings.partners-map.next-buy')
                                                </b>
                                                {{ $mapDate }}
                                            </p>
                                        @else
                                            <p>@lang('base.dash.settings.partners-map.valid-until', ['date' => $mapDate])
                                            </p>
                                        @endif

                                        <label>
                                            <input name="is_active" value="1" type="radio" @if ($mapApp->is_active) checked @endif>
                                            @lang('base.dash.settings.partners-map.renew')
                                        </label>

                                        <label>
                                            <input name="is_active" value="0" type="radio" @if (!$mapApp->is_active) checked @endif>
                                            @lang('base.dash.settings.partners-map.not-renew')
                                        </label>

                                        <div>
                                            <button class="btn btn-primary"
                                                type="submit">@lang('base.dash.settings.partners-map.save')</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <hr class="my-4" />
                                <h6 class="heading-small text-muted mb-4">
                                    @lang('base.dash.settings.partners-map.title')
                                </h6>
                                @lang('base.dash.settings.partners-map.message')
                            @endif
                        @endif

                        <h6 class="heading-small text-muted mb-4 mt-3">
                            @lang('base.dash.settings.2fa.title')
                        </h6>
                        @if (!$user->twofa_secret)
                            <p class="pl-lg-4">@lang('base.dash.settings.2fa.text-disabled')</p>
                            <ol class="list-left-align">
                                <li><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=ru&gl=US&pli=1">
                                    @lang('base.dash.settings.2fa.download-app')
                                </a></li>
                                <li>@lang('base.dash.settings.2fa.scan-qr-code')
                                    @if ($qr_code) <img src="{!! $qr_code !!}" alt="QR Code" /> @endif
                                </li>
                                <li>
                                    <p>Or enter this code into your authentication app: <br> <b>{{ $secret }}</b> </p>
                                </li>
                                <li>@lang('base.dash.settings.2fa.enter-one-time-password')
                                    <form action="{{ route('home.profile.twofa-enable') }}" method="POST"
                                          class="form-inline text-center">
                                        @csrf
                                        <input name="otp" class="form-control mr-1{{ $errors->has('otp') ? ' is-invalid' : '' }}"
                                               type="number" min="0" max="999999" step="1"
                                               required autocomplete="off">
                                        <button type="submit" class="btn btn-sm btn-primary">@lang('base.dash.settings.2fa.button-enable')</button>
                                        @if ($errors->has('otp'))
                                        <span class="invalid-feedback text-left">
                                            <strong>{{ $errors->first('otp') }}</strong>
                                        </span>
                                        @endif
                                    </form>
                                </li>
                            </ol>
                        @else
                          <p class="pl-lg-4">@lang('base.dash.settings.2fa.text-enabled')</p>
                          <form action="{{ route('home.profile.twofa-disable') }}" method="POST"
                                class="form-inline text-center pl-lg-4">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-primary">@lang('base.dash.settings.2fa.button-disable')</button>
                          </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1" id="tab-payment" style="display: none">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-start">
                            <div class="col-5">
                                <h3 class="mb-0">@lang('base.dash.profile.change_pay_info')</h3>
                            </div>
                            <div class="col-7 text-right pl-0">
                                <button class="btn btn-sm btn-primary"
                                    onclick="set_default_tab()">@lang('base.dash.profile.button_profile')</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('home.profile.payments') }}" method="POST">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('base.dash.profile.info_user')</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    {{-- <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"><img
                                                    src="{{ asset('images/lk/pay-1.png') }}" alt=""> Payeer</label>
                                            <input type="text" name="payeer" id="input-username" class="form-control"
                                                placeholder="{{ $wallets['payeer'] }}"
                                                value="{{ $wallets['payeer'] }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"><img
                                                    src="{{ asset('images/lk/pay-2.png') }}" alt=""> Perfect
                                                Money</label>
                                            <input type="text" name="pm" id="input-username" class="form-control"
                                                placeholder="{{ $wallets['pm'] }}" value="{{ $wallets['pm'] }}">
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"><img
                                                    src="{{ asset('images/lk/pay-7.png') }}" alt=""> Tether</label>
                                            <input type="text" name="usdt" id="input-username" class="form-control"
                                                placeholder="{{ $wallets['tether'] }}" value="{{ $wallets['tether'] }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"><img
                                                    src="{{ asset('images/lk/pay-3.png') }}" alt=""> Bitcoin</label>
                                            <input type="text" name="btc" id="input-username" class="form-control" disabled
                                                placeholder="{{ $wallets['btc'] }}" value="{{ $wallets['btc'] }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"><img
                                                    src="{{ asset('images/lk/pay-4.png') }}" alt=""> Etherium</label>
                                            <input type="text" name="eth" id="input-username" class="form-control" disabled
                                                placeholder="{{ $wallets['eth'] }}" value="{{ $wallets['eth'] }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"><img
                                                    src="{{ asset('images/lk/pay-5.png') }}" alt=""> Litecoin</label>
                                            <input type="text" name="ltc" id="input-username" class="form-control"
                                                placeholder="{{ $wallets['ltc'] }}" value="{{ $wallets['ltc'] }}">
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"><img
                                                    src="{{ asset('images/lk/pay-6.png') }}" alt=""> Credit Card</label>
                                            <input type="text" name="card" id="input-username" class="form-control" disabled
                                                placeholder="{{ $wallets['card'] }}" value="{{ $wallets['card'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-sm btn-primary"
                                            value="@lang('base.dash.profile.button_save')">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.modals.notification')
    @include('dashboard.modals.modal-info')


@endsection

@section('js')

    <script src="{{ asset('js/intlTelInput-jquery.min.js') }}"></script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script src="{{ asset('js/autocomplete/autocomplete.min.js') }}"></script>
    <script src="{{ asset('js/autocomplete/city-autocomplete.js') }}"></script>
    <script>
        window.userCountry = "{{ $user->country }}";

        function set_payment_tab() {
            document.getElementById("tab-default").setAttribute("style", "display: none");
            document.getElementById("tab-payment").setAttribute("style", "display: block");
        }
        function set_default_tab() {
            document.getElementById("tab-default").setAttribute("style", "display: block");
            document.getElementById("tab-payment").setAttribute("style", "display: none");
        }

        $form = $('#patch-news-form');
        $form.on('change', function() {
            $(this).find('[type="submit"]').removeClass('disabled');
        });

    </script>
    <script defer>
        $form = $('#patch-news-form');
        $form.on('change', function() {
            $(this).find('[type="submit"]').removeClass('disabled');
        });

        $('#sendSmsCode').on('click', function() {
            let phone = $('#form-phone').val();

            if (phone) {
                let code = $('.form-phone .iti__selected-dial-code').text()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '{{ route('home.profile.send-sms') }}',
                    data: {
                        phone: code + phone
                    },
                    success: function(response) {
                        const result = response.result;

                        if (result) {
                            openNotificationModal('@lang('base.dash.profile.sent_title ')', '@lang('base.dash.profile.sent_message ')')
                        } else {
                            openNotificationModal('@lang('base.general.error ')', '@lang('base.dash.profile.not_sent_message ')')
                        }
                    }
                });
            } else {
                openNotificationModal('@lang('base.dash.profile.phone_empty_title ')', '@lang('base.dash.profile.phone_empty_message ')')
            }

        });

    </script>

    <script defer>
        const $modal = $('#modalInfo');
        const $title = $modal.find('#modal-title');
        const $content = $modal.find('#modal-body');
        
        $form = $("#anket-form");

        if ($form.length > 0) {
            const mainStep = document.querySelector('.step-1');

            mainStep.addEventListener('change', function(e) {
                const {
                    value
                } = e.target;

                document.querySelectorAll(`.step-${value}`).forEach(el => {
                    if (el.classList.contains('d-none'))
                        el.classList.remove('d-none')
                });

                document.querySelectorAll(`.step:not(.step-${value})`).forEach(el => {
                    if (!el.classList.contains('d-none'))
                        el.classList.add('d-none')
                })
            });

            function addAcc() {
                let container = document.querySelector('.multi-accaunts');
                let acc =   `<div class="input-group py-1">
                                <input name="multi-email" type="email" class="form-control" placeholder="email">
                                <button type="button" class="btn btn-danger" onclick="this.closest('.input-group').remove();">X</button>
                            </div>`;
                container.insertAdjacentHTML('beforeend', acc);
            }

            $form.on('submit', onSubmit);

            $form.on('change', function(e) {
                
                const target = e.target;

                if(target.name  === 'phone_verif') {
                    const containers = document.querySelectorAll('.photo-container');
                    target.value === '1' ?
                    containers.forEach(container => {
                        container.classList.add('d-none');
                    })
                    :
                    containers.forEach(container => {
                        container.classList.remove('d-none');
                    });
                    
                }
                
            })
            

            let allowSubmitFetch = true;
            function onSubmit(e) {
                e.preventDefault();
                
                if(!allowSubmitFetch) return;
                
                allowSubmitFetch = false;

                const formData = new FormData(this);

                formData.getAll('multi-email').filter(val => val.length).forEach(element => {
                    formData.append('multi_emails_list[]', element);
                });

                formData.delete('multi-email');
                formData.delete('phone');
                fetch("{{ route('home.verif.store') }}", {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: 'POST',
                        body: formData
                    })
                    .then(res => {
                        return res.json()
                    })
                    .then(res => {
                        if (res.status === 'error') {
                            let errors = Object.values(res.content).map(el => `<p>${el[0]}</p>`).join('');
                            $title.text(res.title);
                            $content.html(errors);
                            $modal.modal('show');
                            allowSubmitFetch = true;
                        } else if (res.status === 'custom-error') {
                            let errors = Array.from(res.content).map(el => `<p>${el}</p>`).join('');
                            $title.text(res.title);
                            $content.html(errors);
                            $modal.modal('show');
                            allowSubmitFetch = true;
                        } else {
                            $title.text(res.title);
                            $content.html(res.content);
                            $modal.modal('show');
                            $('.verif-anket').remove();
                        }
                    })
                    .catch(e => {
                        console.log(e)
                    })
            }
        }

    </script>
@endsection
