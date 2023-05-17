@extends('layouts.dinway', ['title' => 'dinway.pages.aflilate-program'])
@section('content')
    
    @include('dinway.chunks.aflilate-program.hero')
    @include('dinway.chunks.aflilate-program.list-image-title_problems')
    @include('dinway.chunks.aflilate-program.list-image-title_help')
    @include('dinway.chunks.aflilate-program.partners')
    @include('dinway.chunks.aflilate-program.bizes')
    @include('dinway.chunks.plans')
    @include('dinway.chunks.quotes')
    @include('dinway.chunks.partners-map')
    @include('dinway.chunks.we-strong', ['page' => 'investments'])
    @include('dinway.chunks.blog.blog-subscribe')
    @include('dinway.chunks.team-image-only')
    @include('dinway.chunks.faq', ['category' => 'Affiliate program,Партнерская программа'])
    @include('dinway.chunks.companyMaterials')
    @include('dinway.chunks.ticket-form')

    

    @include('dinway.chunks.modal-feedback')
    @include('dinway.chunks.modal-linear-program')
    @include('dinway.chunks.modal-career-program')
    
    
@endsection
