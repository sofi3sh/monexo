<h1 style="text-align: center; color: #1448B6; padding-bottom: 20px">@lang('emails.news.title')</h1>

<div style="overflow: auto; padding-bottom: 20px;">
    <table style="word-break: break-word; border: 1px; width: 100%; min-width: 800px; border-collapse: collapse">
        <thead style="word-break: normal; background-color: #1448B6; color: #ffffff">
            <tr style="text-align: center">
                <th style="padding: 10px; border: 1px solid #000000;ё">@lang('emails.news.table.name')</th>
                <th style="padding: 10px; border: 1px solid #000000;ё">@lang('emails.news.table.text')</th>
                <th style="padding: 10px; border: 1px solid #000000;ё">@lang('emails.news.table.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $index => $post)
                <tr style="@if($index & 1) background-color: #EBF1FE @endif">
                    <td style="padding: 10px; border: 1px solid #000000; border-collapse: collapse">{{$post->name}}</td>
                    <td style="font-size: 16px; line-height: 120%; padding: 10px; border: 1px solid #000000; border-collapse: collapse">{!! $post->excerpt !!}</td>
                    <td style="text-align: center; border: 1px solid #000000; border-collapse: collapse; color: #000000"><a href="{{ route('blog.post.show', $post->slug) }}">@lang('emails.btns.more')</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{$unsubscribeURL}}" style="color: #000000">@lang('emails.btns.unsubscribe')</a>



