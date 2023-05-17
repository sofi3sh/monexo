@extends('layouts.dinway', ['title' => 'dinway.pages.investments'])

@section('content')

    @include('dinway.chunks.investments.hero')
    @include('dinway.chunks.investments.list-image-title_investments-problem')
    @include('dinway.chunks.investments.list-image-title_investments-help')
    @include('dinway.chunks.investments-why')
    @include('dinway.chunks.investments.bizes')
    @include('dinway.chunks.plans')
    @include('dinway.chunks.quotes')
    @include('dinway.chunks.partners-map')
    @include('dinway.chunks.we-strong', ['page' => 'investments'])
    @include('dinway.chunks.blog.blog-subscribe')
    @include('dinway.chunks.team-image-only')
    @include('dinway.chunks.faq', ['category' => 'Investments,Инвестиции'])
    @include('dinway.chunks.ticket-form')


    @include('dinway.chunks.modal-feedback')
    
@endsection
