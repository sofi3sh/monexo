@extends('layouts.dinway', ['title' => 'dinway.pages.education'])
@section('content')
    
    @include('dinway.chunks.education.hero')
    @include('dinway.chunks.education.list-image-title_education-problem')
    @include('dinway.chunks.education.list-image-title_education-help')
    @include('dinway.chunks.education.bizes')
    @include('dinway.chunks.plans')
    @include('dinway.chunks.quotes')
    @include('dinway.chunks.faq', ['category' => 'Education,Образование'])
    @include('dinway.chunks.ticket-form')

    
    @include('dinway.chunks.modal-feedback')
    
@endsection
