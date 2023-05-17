{{-- todo-y Вывод текста новости закомментировал --}}
@foreach($lastNews as $news)
    {{ \Carbon\Carbon::parse($news->created_at)->format('Y-m-d')}} {{ $news->{'header_' . Lang::locale()} }} {{--{{ $news->{'text_' . Lang::locale()} }}--}} <br>
@endforeach