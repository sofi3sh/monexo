@extends('layouts.dinway', ['title' => 'dinway.pages.blog'])

@section('css')

    <style>
        .footer {
            position: relative;
            z-index: 10;
            margin-top: -65px
        }
    </style>
    
@endsection

@section('content')

    <div class="main main-blog">
        @include('dinway.chunks.blog.blog-list')
    </div>

    

@endsection