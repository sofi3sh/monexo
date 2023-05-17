@lang('From client') {{ $content['email'] }}<br>
{{ $content['fio'] }}<br>
@lang('request for the withdrawal of the amount was executed') ${{ $content['sum'] }} @lang('through payment system') {!! $content['payment_system'] !!} @lang('with requisites') {!! $content['requisites'] !!}.
