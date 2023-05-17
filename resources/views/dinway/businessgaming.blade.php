@extends('layouts.dinway', ['title' => 'dinway.pages.businessgaming'])
@section('content')
    
    @include('dinway.chunks.businessgaming.hero')
    @include('dinway.chunks.businessgaming.bizes')
    @include('dinway.chunks.plans')
    @include('dinway.chunks.quotes')
    @include('dinway.chunks.faq', ['category' => 'Business gaming'])
    @include('dinway.chunks.ticket-form')


    

    @include('dinway.chunks.modal-development')
    @include('dinway.chunks.modal-bizes-graybull')
    @include('dinway.chunks.modal-feedback')
    
    

@endsection
