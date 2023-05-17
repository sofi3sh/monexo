<div id="modalInfo" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content pb-4 pl-4 pt-4">
            <button type="button" class="ml-auto mr-2 close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <section class="container">
                    <!-- <div class="about_top_content">
                        <div class="partner_left investors_right">
                            <div class="about_top_content_text main_text">
                                <p>@lang('base.dash.partners.rules-career.title')</p>
                                <ul style="list-style: none">
                                    <li>@lang('base.dash.partners.rules-career.first')<b>5%</b></li>
                                    <li>@lang('base.dash.partners.rules-career.second')<b>3%</b></li>
                                    <li>@lang('base.dash.partners.rules-career.third')<b>2%</b></li>
                                    <li>@lang('base.dash.partners.rules-career.fourth')<b>1%</b></li>
                                    <li>@lang('base.dash.partners.rules-career.fifth')<b>1% @lang('base.dash.partners.rules-career.from_investments')</b></li>
                                </ul>
                            </div>
                            <p class="investors_left">
                                <img src="/img/svg/diagramma-3.svg" alt="partner" style="max-width: 300px;">
                            </p>
                            @lang('base.dash.partners.rules-career.3-1-1')
                            {{-- <div>
                                @lang('base.dash.partners.rules-career.description')
                            </div> --}}
                        </div>
                    </div> -->

                    <img src="{{ asset('monexo/linear-en.svg') }}" style="width: 100%; overflow-x: auto" class="my-2">
                </section>
            </div>
        </div>
    </div>
</div>

@php
    $userRegionalRepresentativeStatusRequest = optional(auth()->user()
            ->statusRequests()
            ->where('request_status', \App\Models\UserStatusRequest::STATUS_WAIT)
            ->where('user_status_id', \App\Models\UserStatus::STATUS_REGIONAL_REPRESENTATIVE)
            ->latest()
            ->first())
            ->toArray() ?: [];

        $formValues = [
            'region' => old('region') ?: session('region') ?: $userRegionalRepresentativeStatusRequest['extra_data']['region'] ?? '',
            'social_networks' => old('social_networks') ?: session('social_networks') ?: $userRegionalRepresentativeStatusRequest['extra_data']['social_networks'] ?? [],
            'comment' => old('comment') ?: session('comment') ?: $userRegionalRepresentativeStatusRequest['extra_data']['comment'] ?? '',
        ];
@endphp

<div id="regional-representative-available-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content pb-4 pl-4 pt-4">
                <section class="container">
                    <div class="content">
                        @if($userRegionalRepresentativeStatusRequest)
                            <p class="text-xl text-center text-green">{{__('You can update request')}}</p>
                        @endif
                        <form method="post" action="{!! route('home.partner.regional-representative.request.create') !!}">
                            @csrf

                            <input type="hidden" data-instagram-price value="{{ \App\Models\UserStatusRequest::REGIONAL_REPRESENTATIVE_STATUS_TELEGRAM_PRICE }}">
                            <input type="hidden" data-telegram-price value="{{ \App\Models\UserStatusRequest::REGIONAL_REPRESENTATIVE_STATUS_INSTAGRAM_PRICE }}">

                            <div class="form-group">
                                <label for="region" class="@error('region') text-danger @enderror">@lang('base.dash.partners.region')</label>
                                <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region" value="{{$formValues['region']}}" placeholder="@lang('base.dash.partners.region')">
                            </div>
                            <div class="form-group">
                                <label for="region">@lang('base.dash.partners.social_networks')</label>
                                <div class="form-check">
                                    <input class="form-check-input @error('social_networks') is-invalid @enderror" type="checkbox" name="social_networks[]" value="telegram" id="telegram" @if(in_array('telegram', $formValues['social_networks'])) checked @endif>
                                    <label class="form-check-label @error('social_networks') text-danger @enderror" for="telegram">
                                        Telegram
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('social_networks') is-invalid @enderror" type="checkbox" name="social_networks[]" value="instagram" id="instagram" @if(in_array('instagram', $formValues['social_networks'])) checked @endif>
                                    <label class="form-check-label @error('social_networks') text-danger @enderror" for="instagram">
                                        Instagram
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price">@lang('base.dash.partners.price')</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" value="0 USD" readonly placeholder="@lang('base.dash.partners.price')">
                            </div>
                            <div class="form-group">
                                <label for="comment">@lang('base.dash.partners.comment')</label>
                                <textarea class="form-control summernote" id="comment" name="comment" rows="2" placeholder="@lang('base.dash.partners.comment')">{{$formValues['comment']}}</textarea>
                            </div>
                            <button type="submit" disabled class="btn btn-sm btn-primary">
                                @if($userRegionalRepresentativeStatusRequest)
                                    @lang('base.dash.partners.update_request')
                                @else
                                    @lang('base.dash.partners.send_request')
                                @endif
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<div id="regional-representative-inactive-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content pb-4 pl-4 pt-4">
                <section class="container">
                    <div class="content">{{__('To obtain the status of a regional representative, you must reach the 6th level in the career program')}}</div>
                </section>
            </div>
        </div>
    </div>
</div>

