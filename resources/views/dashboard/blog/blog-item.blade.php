@extends('dashboard.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
@endsection

@section('content')
    
    <div class="main-blog">
        @include('dinway.chunks.blog.blog-item', ['lk' => 1])
    </div>
    
@endsection