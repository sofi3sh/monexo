@extends('dashboard.app')


@section('content')
    <div class="container-fluid py-3">
        <h1 class="text-center">
            @lang('base.dash.regulations.title')
        </h1>
        @foreach ($sections as $section)
            <h2 class="h3">{{$section['title']}}</h2>
            <ul>
                @foreach ($section['items'] as $item )
                    <li>
                        {{$item}}
                    </li>                
                @endforeach
            </ul>
            @isset($section['add-info'])
            <p class="h4">{{$section['add-info']}}</p>
            @endisset
        @endforeach
    </div>    
@endsection