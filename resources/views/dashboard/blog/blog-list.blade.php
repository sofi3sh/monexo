@extends('dashboard.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
    <style>
        .blog-slider-menu {
            list-style: none;
        }
        .blog-cards {
            margin-bottom: 40px;
        }
    </style>
@endsection

@section('content')
    
    @include('dinway.chunks.blog.blog-list', ['lk' => 1])
    
@endsection


@section('js')
    <script src="{{asset('js/blog.js')}}"></script>
@endsection