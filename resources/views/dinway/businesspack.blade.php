@extends('layouts.dinway', ['title' => 'dinway.pages.businesspack'])
@section('content')
    
    @include('dinway.chunks.businesspack.hero')
    @include('dinway.chunks.list-image-title_promotion')
    @include('dinway.chunks.list-image-title_advantages')
    @include('dinway.chunks.businesspack.bizes')
    @include('dinway.chunks.instruction')
    @include('dinway.chunks.plans')
    @include('dinway.chunks.quotes')
    @include('dinway.chunks.faq', ['category' => 'Business pack'])
    @include('dinway.chunks.ticket-form')

    

    @include('dinway.chunks.modal-audit-info')
    @include('dinway.chunks.modal-price')
    @include('dinway.chunks.modal-feedback')
@endsection
