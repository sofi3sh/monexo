@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <h2 class="h4">Заголовок: {!! $withdrawalModal->title !!}</h2>
        <h3 class="h4">Контент:</h3> 
        <div>
            {!! $withdrawalModal->content !!}
        </div>
        <div class="mb-3">
            <a href="/lang/ru" class="btn btn-secondary btn-sm">ru</a>
            <a href="/lang/en" class="btn btn-secondary btn-sm">en</a>
        </div>
        <button class="btn btn-dark" data-toggle="modal" data-target="#withdrawalModal">Показать в модальном окне</button>
        <a href="{{route('admin.withdrawalModalInfo.edit')}}" class="btn btn-secondary">Изменить</a>
        <style>
            .modal-backdrop {
                display: none !important;
            }
        </style>
        <div style="z-index: 1000000000">
            @include('dashboard.balance.withdrawal-modal')
        </div>
        
    </div>
@endsection