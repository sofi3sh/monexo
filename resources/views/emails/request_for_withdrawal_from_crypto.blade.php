@lang('From client') {{ $content['email'] }}<br>
@lang('request for the withdrawal of the amount was executed') ${{ $content['amount_usd'] }} @lang('on') {!! $content['wallet'] !!} @lang('wallet') {!! $content['address'] !!}
@if(!is_null($content['additional_data']))@endif @lang('add. requisites'): {!! $content['additional_data'] !!}.
