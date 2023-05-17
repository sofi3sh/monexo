@extends('layouts.dinway', ['title' => 'dinway.pages.blogtime'])

@section('content')
    
    @include('dinway.chunks.blogtime.hero')
    @include('dinway.chunks.blogtime.list-image-title_blogtime-problem')
    @include('dinway.chunks.blogtime.list-image-title_blogtime-help')
    @include('dinway.chunks.blogtime.instruction')
    @include('dinway.chunks.blogtime.bizes')
    @include('dinway.chunks.plans')
    @include('dinway.chunks.quotes')
    @include('dinway.chunks.faq', ['category' => 'Blogtime'])
    @include('dinway.chunks.ticket-form')

    

    

    @include('dinway.chunks.modal-feedback')
    
    

@endsection
