{{--@lang('Hello, you left a question on the site monexo-invest.com'):<br>--}}
{{ trans('ticket.email.hello')}}
Email {{ $content['email'] }}<br>
@lang('Question:') {{ $content['question'] }}<br>
<hr>
<strong>
@lang('Answer:') {{ $content['answer'] }}
</strong>

