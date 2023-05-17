@extends('layouts.dinway', ['title' => 'dinway.pages.faq'])


@section('content')
    <section class="py-3">
        <div class="container">
            <h1 class="text-center title mb-1">
                @lang('base.dash.regulations.title')
            </h1>
            @foreach ($sections as $section)
                <h2 class="regulations-title">{{$section['title']}}</h2>
                <ul class="regulations-list">
                    @foreach ($section['items'] as $item )
                        <li>{{$item}}</li>                
                    @endforeach
                </ul>
                @isset($section['add-info'])
                    <p>{{$section['add-info']}}</p>
                @endisset
            @endforeach
        </div>   
    </section>
@endsection