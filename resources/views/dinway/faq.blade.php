@extends('layouts.dinway', ['title' => 'dinway.pages.faq'])

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

    <div class="faq-page">
        @include('dinway.chunks.faq-search')
        @include('dinway.chunks.faq-questions')
    </div>

    @include('dinway.chunks.modal-feedback')
@endsection
