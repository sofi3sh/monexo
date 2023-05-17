@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <h2 class="mb-3">Карта партнеров</h2>
        <a class="btn btn-primary" href="{{route('admin.partners-map.buy.index')}}">Перейти к покупкам</a>
    </div>
    @include('dinway.chunks.partners-map', ['lk' => 1, 'show' => 1])
    <div class="container-fluid mt-3">
        <div class="mb-3">
            {{$partnersMap->show ? "Опубликовано" : "Не опубликовано"}}
        </div>
        <a href="{{route('admin.partners-map.edit')}}" class="btn btn-dark">Изменить</a>
    </div>
@endsection
