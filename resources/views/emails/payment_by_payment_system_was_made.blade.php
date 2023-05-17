@lang('From client'): {{ $content['fio'] }}<br>
Email: {{ $content['email'] }}<br>
@lang('Phone'): {{ $content['phone'] }}<br>
{{ trans('notifications.email.payment_was_made_view', $content) }}
