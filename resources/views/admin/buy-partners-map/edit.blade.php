@extends('layouts.admin')


@section('content')
    <div class="alert">
        @foreach ($errors->all() as $error)
            {{$error}}    
        @endforeach
    </div>
    <div class="container-fluid">
        <h1 class="h4">Редактирование > Покупка места на карте партнеров</h1>
        <form action="{{route('admin.partners-map.buy.update')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title_ru">Заголовок на русском</label>
                <input class="form-control" type="text" id="title_ru" name="title_ru" value="{{$info->getTranslation('title', 'ru')}}">
            </div>
            <div class="form-group">
                <label for="title_en">Заголовок на английском</label>
                <input class="form-control" type="text" id="title_en" name="title_en" value="{{$info->getTranslation('title', 'en') ?? ''}}">
            </div>
            <div class="form-group">
                <label for="text_info_ru">Описание (на русском):</label>
                <textarea row="5" class="form-control" type="text" id="text_info_ru" name="text_info_ru">{!! $info->getTranslation('text_info', 'ru')!!}</textarea>
            </div>
            <div class="form-group">
                <label for="text_info_ru">Описание (на английском):</label>
                <textarea row="5" class="form-control" type="text" id="text_info_en" name="text_info_en">{!! $info->getTranslation('text_info', 'en') !!}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Цена места на карте партнеров ($):</label>
                <input class="form-control" type="text" id="price" name="price" value="{{$info->price}}">
            </div>
            <div class="form-group">
                <label for="level">Доступно с уровня:</label>
                <input class="form-control" type="text" id="level" name="level" value="{{$info->level}}">
            </div>
            <button class="btn btn-dark" type="submit">Сохранить</button>
            <a class="btn btn-secondary" href="{{route('admin.partners-map.buy.index')}}">Назад</a>
        </form>
    </div>
@endsection