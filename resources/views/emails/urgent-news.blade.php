<h1 style="text-align: center; color: #1448B6; padding-bottom: 20px">{{$post->name}}</h1>
{{-- <div style="text-align:center;">
    <img src="{{$post->image}}" alt="Post image" style="padding-bottom: 20px; max-width: 100%;">
</div> --}}
<p style="padding-bottom: 20px; line-height: 120%; color: #000000; font-size: 16px">
    {!! $post->content !!}
</p>
<a href="{{$unsubscribeURL}}" style="color: #000000">@lang('emails.btns.unsubscribe')</a>


