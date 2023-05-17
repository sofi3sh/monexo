<p>{{ trans('notifications.invite.hello') }}</p>
<p>{{ trans('notifications.invite.your') . $content['fullName'] }}</p>
<p>{{ trans('notifications.invite.activation') }}
    <a href="{{$content['link']}}">{{trans('notifications.invite.link_text')}}</a>
    {{ trans('notifications.invite.to_fill') }}
</p>
@isset($content['packageName'])
    <p>{{ trans('notifications.invite.profit') }}</p>
    <p>{{ trans('notifications.invite.package_name') }}<strong>{{ $content['packageName'] }}</strong></p>
    <p>{{ trans('notifications.invite.package_amount') }}<strong>{{ $content['packageAmount'] }}</strong></p>
@endisset
<p>{{ trans('notifications.invite.good_day') }}</p>
<p>{{ trans('notifications.invite.respect') }}</p>
