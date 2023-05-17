@extends('dashboard.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/faq.css')}}">
    <style>
        
        .faq-questions-list {
            list-style-type: none;
            padding: 0;
            background-color: var(--secondary);
        }
        
        .question__text {
            margin: 0;
        }

        .faq-search {
            background-color: var(--primary);
        }

        .faq-questions__container {
            overflow: initial !important;  
        }

    </style>
    <main class="faq-page">
        @include('dinway.chunks.faq-search')
        @include('dinway.chunks.faq-questions')
    </main>
    
    <script src="{{asset('js/faq.js')}}"></script>
@endsection