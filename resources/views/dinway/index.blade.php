@extends('layouts.dinway', ['title' => 'dinway.pages.index'])
@section('content')
    123
    @include('dinway.chunks.main.hero')
    @include('dinway.chunks.about')
    @include('dinway.chunks.mlmup-block')
    @include('dinway.chunks.why')
    @include('dinway.chunks.main.bizes')
    {{-- @include('dinway.chunks.main.simple-slider') --}}
    @include('dinway.chunks.plans')
    {{-- @include('dinway.chunks.team') --}}
    @include('dinway.chunks.quotes')
    @include('dinway.chunks.partners-map')
    @include('dinway.chunks.we-strong', ['page' => 'main'])
    @include('dinway.chunks.team-image-only')
    @include('dinway.chunks.faq', ['category' => 'Popular,Популярное'])
    @include('dinway.chunks.news')
    @include('dinway.chunks.blog.blog-subscribe')
    @include('dinway.chunks.ticket-form')



    @include('dinway.chunks.modal-feedback')


    @php
        $btn1 = trans('dinway.strategy.years');
        $btn2 = trans('dinway.strategy.months');
    @endphp
    @include('dinway.chunks.modals.micromodal', [
        'id' => 'modal-strategy',
        'title' => trans('dinway.strategy.title'),
        'content' => "
        <div class=\"d-flex justify-evenly\">
            <a class=\"custom-link\"
            href=\"https://speakerdeck.com/dinway/dinway-fintech-solutions-priezientatsiia-planov-na-5-10-liet\"
            target=\"_blank\"
            >
                $btn1
            </a>
            <a
            href=\"https://speakerdeck.com/dinway/dinway-fintech-solutions-priezientatsiia-planov-do-avghusta-2021\"
            target=\"_blank\"
            class=\"custom-link\" href=\"#\">$btn2</a>
        </div>
        "
    ])
@endsection
