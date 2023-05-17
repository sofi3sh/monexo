@lang('Customer feedback'):<br>
1. Email: {{ $request->email }}<br>
2. @lang('Full name'): {{ $request->fio }}<br>
3. @lang('Phone'): {{ $request->phone }}<br>
4. @lang('Messenger'): {{ $request->messenger }}<br>
5. @lang('Selected sites'):<br>
@foreach($request->website as $website => $check)
    @lang('Web site'): {{ $website }}<br>
@endforeach
<br>
@if(!is_null($request->comment)) @lang('Comment'): {{ $request->comment }}<br>@endif
