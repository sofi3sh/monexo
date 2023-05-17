{{-- Подшаблон с курсами криптовалют  --}}
{{-- Курсы --}}
<div class="rates-bg">
    <div class="rates">
        @foreach($rates as $rate)
            <div class="rate">
                {{-- Иконка криптовалюты --}}
                <div class="rate__icon"><img src="{{ asset('/currencies-img/'.$rate->code.'.png') }}" class="img-fluid"></div>
                {{-- Курс и индикатор направления изменения курса --}}
                <div>
                    <div class="rate__currency">{{ $rate->code }}/USD</div>
                    {{-- Индикатор изменения курса --}}
                    <div class="rate__value">
                        {{ $rate->rate }}
                        <div class=@if($rate->trend>0) rate__up @else rate__down @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                 viewBox="0 0 24 24">
                                <path d="M24 22h-24l12-20z"/>
                            </svg>
                        </div>
                    </div>
                    {{-- Знаачение изменения курса --}}
                    <div class="rate__daily @if($rate->trend>0) rate__daily--green @else rate__daily--red @endif">
                        {{ $rate->trend }}%
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    <div class="rates-control">
        <button class="rates-control-btn rcb--view-all rcb--visible">{{ __('strings.backend.home.view-all') }}</button>
        <button class="rates-control-btn rcb--hide-all">{{ __('strings.backend.home.hide-all') }}</button>
    </div>
</div>