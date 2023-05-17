@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if($errors->any())
            @foreach($errors->all() as $key => $error)
                <div class="alert alert-danger">{{ $key }} {{ $error }}</div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-12">
                <br>

                <div class="admin-content-block">
                    <div class="row">
                        <div class="col-sm-9">
                            @if(isset($suggestionType))
                                <h3>Редактироание типа "пожеланий и предложений" (идей)</h3>
                            @else
                                <h3>Новый тип "пожеланий и предложений" (идей)</h3>
                            @endif

                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-primary btn-sm" href="{{route('admin.suggestion-types.index')}}">К списку</a>
                        </div>
                    </div>

                    <form method="post" action="{{ $action_route }}">

                        @method($action_method)
                        @csrf

                        <div class="form-group">
                            <label for="suggestionTitleRu">Название на русском</label>
                            <input type="text" class="form-control" id="suggestionTitleRu" name="title_ru"
                                   value="{{isset($suggestionType) ? $suggestionType->title_ru : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="suggestionTitleEn">Название на английском</label>
                            <input type="text" class="form-control" id="suggestionTitleEn" name="title_en"
                                   value="{{isset($suggestionType) ? $suggestionType->title_en : ''}}">
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.suggestion-types.index') }}">
                                <button type="button" class="btn btn-outline-primary">
                                    Назад
                                </button>
                            </a>

                            <button type="submit" class="btn btn-primary">
                                {{ $action_name }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
