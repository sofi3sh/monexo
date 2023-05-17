<h1 style="text-align: center; color: #1448B6; padding-bottom: 20px">
   @lang('emails.partners.title') {{ $user->name }}
</h1>

<h2><b>@lang('emails.partners.theme')</b>{{$title}}</h2>
<h2>@lang('emails.partners.content')</h2>
<p style="font-size: 16px; line-height: 120%">
    {{$content}}
</p>

<a href="{{route('website.home')}}" style="font-size: 14px; color: #1448B6;">
    @lang('emails.partners.tosite')
</a>
{{-- <a href="{{$unsubscribeURL}}" style="color: #000000">@lang('emails.btns.unsubscribe')</a> --}}



